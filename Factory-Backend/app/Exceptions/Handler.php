<?php

namespace App\Exceptions;

use Throwable;
use App\Helpers\ApiRes;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ClientApiValidationException) {
            //自定义exception 返回方法
            //这里可以返回first，也可以返回all(),根据自己需要返回
            return ApiRes::resFormat($e->status , $e->status , $e->getMessage() , ['errors'=>$e->validator->errors()]);
        }

        if ($e instanceof ClientApiAuthException) {
            return ApiRes::resFormat(401 , 401 , $e->getMessage());
        }

        return parent::render($request, $e);
    }
}
