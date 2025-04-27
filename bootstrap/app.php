<?php

use App\Http\Middleware\ProfileIncomplete;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
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
        
        $handler->renderable(function (Throwable $e):JsonResponse|null  {
            
            $statusCode = $e instanceof HttpException ? $e->getStatusCode() : 500;

            if ($e instanceof ValidationException) {
                return null;  // Let it to default  Laravel's validation error
            }   

            $message = match(true) {
                $statusCode === 404 => 'Not found',
                $statusCode === 500 => 'Something went wrong',
                default => $e->getMessage() ?? 'An error occurred'
            };
            
            $message= isEmpty($e->getMessage()) ? $e->getMessage() : ' An error occurred' ;
            
            $statusCode = $e instanceof HttpException ? $e->getStatusCode() : 500; 

            
            return response()->json([
                'message' => $message
            ], $statusCode);

        }
    );
    })->create();
