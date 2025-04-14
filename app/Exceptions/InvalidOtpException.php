<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InvalidOtpException extends BaseApiException
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {   
       $message = empty($this->getMessage())  ? __('message.OTP_invalid') : $this->getMessage() ;

        $code = $this->getCode() ?: 400;


        return $this->errorResponse($message ,'',$code);


    }
}
