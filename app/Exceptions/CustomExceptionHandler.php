<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\{ HttpException, MethodNotAllowedHttpException, NotFoundHttpException };

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, \Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            // You can customize the response here
            return response()->view('errors.method_not_allowed', [], 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            // Custom 404 page or redirect
            return response()->view('errors.404', [], 404);
        }

        return $this->handle500Error($request, $exception);
    }

    protected function handle500Error($request, $exception)
    {
        if ($exception instanceof HttpException && $exception->getStatusCode() == 500) {
            // Add custom logic for logging 500 errors
            Log::error(json_encode($request) . '\n500 internal server error: ' . $exception->getMessage());
            // Log the exception or perform other actions as needed
            return response()->view('errors.500', [], 500);
        }

        // Handle other types of exceptions
        return parent::render($request, $exception);
    }
}
