<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProfileIncomplete 
{
    public function handle(Request $request, Closure $next)
    {

        $temporaryToken=$request->bearerToken();
        
        $userId=Cache::get($temporaryToken);

        if ($userId) {
            $request->request->add(['userId'=>$userId]); 

            return $next($request); 
        }

        return response()->json(['message' => 'Unauthorized.'], 401);
    
    }


}
