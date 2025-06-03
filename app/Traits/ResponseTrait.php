<?php

namespace App\Traits;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

trait ResponseTrait
{

    public function authSuccessResponseWithCookie($message, $token, $data = null, $code = 200)
    {

        $cookie = cookie('token', $token,60 * 24 *30 , null, null, true, true); 

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code)->withCookie($cookie);
        
        
    }

    public function authLogoutResponseWithExpiredCookie($message)
    {
        $expiredCookie = cookie()->forget('token');
        
        return response()->json([
            'status' => true,
            'message' => $message,
        ])->withCookie($expiredCookie);
        
    }

    public function authSuccessResponse($message, $token, $data = null, $code = 200)
    {

        if ($data instanceof JsonResource) {
            $dataArray = $data->toArray(request());
        } else {
            $dataArray = $data ? $data->toArray() : [];
        }
    
        return response()->json([
            'status' => true,
            'message' => $message,
            'user' => $data,
            'token'=>$token
        ], $code);
        
        
    }

    public function paginateSuccessResponse($message, $data, $code = 200)
    {   

        
        return response()->json([
            'message' => $message,
            'status' => true,
            'data' =>  $data->items(),
            'meta' => [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage(),
            ],
        ]);
    }

    public function dataSuccessResponse($message, $res_code, $data, $code = 200)
    {

        return response()->json([
            'status' => true,
            'res_code' => $res_code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function noDataResponse($code = 204)
    {
        return response()->json([
            'status' => true,
        ], $code);
    }
    public function notFoundResponse($error_number, $message = 'not found', $code = 404)
    {
        return response()->json([
            'message' => $message,
            'status' => false,
            'error_number' => $error_number
        ], $code);
    }
    public function successResponse($message, $res_code = '', $code = 200)
    {

        return response()->json([
            'status' => true,
            'message' => $message,
            'res_code' => $res_code,
        ], $code);
    }



    public function errorResponse($message, $error_number, $code = 500)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'err-number' => $error_number
        ], $code);
    }

}
