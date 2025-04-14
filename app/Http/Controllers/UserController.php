<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidOtpException;
use App\Exceptions\OtpRequestLimitExceededException;
use App\Http\Requests\User\CompleteProfileRequest;
use App\Http\Requests\User\OtpRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\ValidOtpRequest;
use App\Http\Resources\UserResource ;
use App\Models\Staff;
use App\Models\User;
use App\Services\OtpService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService,protected OtpService $otpService) {}
   
    public function requestOtp(OtpRequest $request)
    {   
        try{

            $this->otpService->requestOtp($request); 
        
        }
        catch(OtpRequestLimitExceededException $e){
            throw $e;
        }
        catch(InvalidOtpException $e){
            throw $e;
        }
        catch(\Exception $e){
            throw $e;
            return $this->errorResponse($e->getMessage(),'',$e->getCode());
        }


        return $this->successResponse(__('messages.otp_sent'), '');
    }
    
    public function verifyOtp(ValidOtpRequest $request)
    {
       
        // $expectedExceptions=[OtpRequestLimitExceededException::class , OtpRequestLimitExceededException::class ,InvalidOtpException::class,\Exception::class];


        try{

          $user=  $this->otpService->verifyOtp($request);
        }
        catch(OtpRequestLimitExceededException $e){
            throw $e;
        }
        catch(InvalidOtpException $e){
            throw $e;
        }
        catch(\Exception $e){
            throw $e;
        }
        // catch(\Throwable $e){
        //     foreach ($expectedExceptions as $exceptionClass) {
        //         if ($e instanceof $exceptionClass) {
        //             throw  $e;
        //         }
        //     }
            
        //     throw $e;
        
        // }


        
        return $user->first_name?
         $this->authSuccessResponse(__('message.otp_valid'),$user->createToken('API TOKEN')->plainTextToken,new UserResource($user)):
         $this->authSuccessResponse(__('message.otp_valid'),$this->userService->setTemporaryToken($user),"",202);
        
    
         
        
    }

    public function completeProfile(CompleteProfileRequest $request){


        $user= $this->userService->completeProfile($request,$request->userId);


        
        return $this->authSuccessResponse(
            __('message.done'),
            $user->createToken('API TOKEN')->plainTextToken,
            new UserResource($user));

    }

    public function update(UpdateUserRequest $request):JsonResponse
    {
       

      
        $user= $this->userService->updateUser($request);
        
        return $this->dataSuccessResponse(
            __('messages.account_updated'),
            '',
            new UserResource($this->userService->updateUser($request,$user)),
        );
    }
  

    public function logout()
    {       

        request()->user()->currentAccessToken()->delete();
        
        return $this->successResponse(__('messages.logout_successfully'), '');
    }
}
