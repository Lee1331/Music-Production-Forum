<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //if this is an authentication exception...
        if($exception instanceof AuthenticationException){
            //check the guard, and redirect appropriately
                //array_get - Laravel Helper function, searches for a value/key in an array, returns '0' in this case if it isn't found - https://laravel.com/docs/5.7/helpers#method-array-get
            $guard = array_get($exception->guards(), 0);
            switch($guard){
                case 'admin':
                    return redirect(route('admin.login'));
                    break;
                default:
                    return redirect(route('login'));
                    break;
            }
        }
        return parent::render($request, $exception);
    }
}
