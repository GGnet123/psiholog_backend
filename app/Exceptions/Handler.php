<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        CustomException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
            //
        });
    }


    public function render($request, $e)
    {
        if ($request->is('api/*') && $e instanceof  CustomException){
            return $this->handleApiException($request, $e);
        }


        return parent::render($request, $e);
    }

    private function handleApiException($request, $e){
        return response()->json([
            'success' => false,
            'status_code' => $e->getCode(),
            'message' => $e->getMessage(),
            'exception_class' => (new \ReflectionClass($e))->getShortName()
        ], $e->HTTP_CODE);
    }

}
