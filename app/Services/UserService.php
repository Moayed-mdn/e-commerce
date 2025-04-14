<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
class UserService
{   
    public function completeProfile($request,$userId):User
    {

        $user= User::findOrFail($userId);

        $user->update($request->validated());

        $this->deleteTemporaryToken();

        return $user;

    }
    
    public function updateUser($request):User
    {   

        $user=request()->user();
   
        $user->update($request->validated());

        return $user;
    }
    

    
    
    
    
    public function setTemporaryToken(User $user){
       
        $temporaryToken=(string)Str::uuid();

        
        Cache::put($temporaryToken,$user->id,Carbon::now()->addMinutes(15));


        return $temporaryToken;
    }

    protected function deleteTemporaryToken():void
    {
        $temporaryToken=request()->bearerToken();

        Cache::forget($temporaryToken);
        
    }
  
    
    


    public function storeOtpInCache($request,$otp){

        $key=$request->email?? $request->phone_number;
        $expireDate=Carbon::now()->addMinutes(5);
        
        Cache::put($key,$otp,$expireDate);

    }

    

 
}
