<?php

use App\Http\Middleware\ProfileIncomplete;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function PHPUnit\Framework\isEmpty;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'profileIncomplete' => ProfileIncomplete::class,
        ]);
    })
    ->withExceptions(function (Exceptions $handler) {
        
        $handler->renderable(function (Throwable $e):JsonResponse  {

            $message= isEmpty($e->getMessage()) ? $e->getMessage() : ' An error occurred' ;
            $statusCode = $e instanceof HttpException ? $e->getStatusCode() : 500; // Default to 500 if not an HttpException

            return response()->json([
                'error'=>$message,
                'message' => 'An error occurred', 
            ], $statusCode); 
        }
    );
    })->create();
