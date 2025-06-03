<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProfileIncomplete 
{
    public function handle(Request $request, Closure $next)
    {

        $temporaryToken=$request->bearerToken();
        
        $message=$temporaryToken==null ? "it is null " : " it is NOT null";

        Log::alert('THIS IS '. $message);
        
        $userId=Cache::get($temporaryToken);
        

        if ($userId) {
            $request->request->add(['userId'=>$userId]); 

            return $next($request); 
        }

        return response()->json(['message' => 'Unauthorized.'], 401);
    
    }


}
