<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OtpRequestLimitExceededException extends BaseApiException
{



    public function render(Request $request):JsonResponse
    {

        $message = empty($this->getMessage())  ? __('message.OTP_too_many_requests') : $this->getMessage() ;

        $code = $this->getCode() ?: 429;


        return $this->errorResponse($message ,'',$code);


    }
}



