<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            
        });

        /*$this->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                \Log::error('Auth Failure: ' . $e->getMessage(), [
                    'guards' => $e->guards(),
                    // This will tell us if Apache is actually sending the token to PHP
                    'header' => $request->header('Authorization') ? 'Present' : 'Missing',
                    'full_header' => $request->header('Authorization'), 
                ]);

                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated.',
                    'debug_info' => 'Check your laravel.log for details'
                ], 401);
            }
        });*/
        
    }
	
	
	 function render($request, Throwable $exception)
	 {
			 
        if ($this->isHttpException($exception)) 
		 {
             if ($exception->getStatusCode() == 500) 
			 {
                return response()->view('errors.500', [], 500);
             }
         }
			return parent::render($request, $exception);
     }
	
	
	
	
}
