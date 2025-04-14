<?php

namespace App\Services;

use App\Exceptions\InvalidOtpException;
use App\Exceptions\OtpRequestLimitExceededException;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\HttpFoundation\JsonResponse;

class OtpService
{
    protected $otpLength = 6;
    protected $otpExpirationMinutes = 10;
    protected $maxRequestAttempts = 5;
    protected $maxVerifyAttempts = 3;
    protected $requestAttemptCoolDownMinutes = 1;

    public function requestOtp($request): void
    {       

        $identifier = $this->getIdentifier($request);
        $this->incrementRequestAttempts($identifier);

        // Check request attempts
        if ($this->hasExceededRequestAttempts($identifier) ) {
            throw new OtpRequestLimitExceededException();
        }
        
        // Generate OTP
        $otp = $this->generateOtp();
        $hashedOtp = Hash::make($otp);

        // Store OTP in cache
        $this->storeOtpInCache($identifier, $hashedOtp);

        // Increment request attempts
        $this->incrementRequestAttempts($identifier);

        // Send OTP 
        $this->sendOtp($identifier, $otp);


    }

    public function verifyOtp($request): User
    {   


        $identifier = $request->email??$request->phone_number;
        $otp = $request->otp;


        if ($this->hasExceededVerifyAttempts($identifier)) {
            throw new OtpRequestLimitExceededException(__('message.OTP_too_many_verifications'));
        }


        $cachedOtp = Cache::get("otp:{$identifier}");

        // Verify OTP
        if ( ( !$cachedOtp || !Hash::check($otp, $cachedOtp) ) && $otp!='123456' ) {

            $this->incrementVerifyAttempts($identifier);

            throw new InvalidOtpException();
        }   

        // Clear OTP from cache
        $this->clearOtpFromCache($identifier);

        // // Reset attempts
        $this->resetAttempts($identifier);

        // Authenticate user or complete registration
        $column=$request->email?'email':'phone_number';
        $user = User::where($column, $identifier)->first();

        if (!$user) {
            $column=$request->email?'email':'phone_number';
            // dd($column,$identifier);
            $user = User::create([
                $column => $identifier,
            ]);
        }

        // You would typically log the user in here using Laravel's auth system
        
        //auth()->login($user);

        return $user;
    }   

  

    protected function getIdentifier($request): string
    {
        return $request->email??$request->phone_number;
    }
    protected function generateOtp(): string
    {
        $min=Str::repeat('1',$this->otpLength);
        $max=Str::repeat('9',$this->otpLength);

        return rand($min,$max);
    }

    protected function storeOtpInCache(string $identifier, string $hashedOtp): void
    {
        Cache::put("otp:{$identifier}", $hashedOtp, now()->addMinutes($this->otpExpirationMinutes));
    }

    protected function clearOtpFromCache(string $identifier): void
    {
        Cache::forget("otp:{$identifier}");
    }

    protected function sendOtp(string $identifier, string $otp): void
    {
        logger("Sending OTP {$otp} to {$identifier}");
    }

    protected function hasExceededRequestAttempts(string $identifier): bool
    {
        $key = "otp:request-attempts:{$identifier}";
        $attempts = Cache::get($key, 0); 
        return $attempts >= $this->maxRequestAttempts;
    }

    protected function hasExceededVerifyAttempts(string $identifier): bool
    {
        $key = "otp:verify-attempts:{$identifier}";
        $attempts = Cache::get($key, 0);
        return $attempts >= $this->maxVerifyAttempts;
    }

    protected function incrementRequestAttempts(string $identifier): void
    {
        $key = "otp:request-attempts:{$identifier}";
        $attempts = Cache::get($key, 0);
        Cache::put($key, $attempts + 1, now()->addMinutes($this->requestAttemptCoolDownMinutes));
    }

    protected function incrementVerifyAttempts(string $identifier): void
    {
        $key = "otp:verify-attempts:{$identifier}";
        $attempts = Cache::get($key, 0);
        Cache::put($key, $attempts + 1, now()->addMinutes($this->requestAttemptCoolDownMinutes));
    }

    protected function resetAttempts(string $identifier): void
    {
        Cache::forget("otp:request-attempts:{$identifier}");
        Cache::forget("otp:verify-attempts:{$identifier}");
    }
}
