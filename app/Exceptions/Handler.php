<?php

namespace App\Exceptions;

use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use App\Exceptions;

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
            if($e instanceof NotFoundHttpExceptiont){
                return response()->view('errors.404',compact('e'), 404);
            }
            if($e instanceof ModelNotFoundException){
                return response()->view('errors.404',compact('e'), 404);
            }});
    }

//    protected function unauthenticated($request, AuthenticationException $exception)
//    {
//       return $request->expectsJson()
//           ? response()->json(['message'=>'Unauthenticated'],401)
//           :redirect()->guest(route('user.login'));
//    }

//    protected function redirectTo($request): string
//    {
//        if (! $request->expectsJson()) {
//
//            return route('user.login');
//
//        }
//    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // return $request->expectsJson()
        //             ? response()->json(['message' => $exception->getMessage()], 401)
        //             : redirect()->guest(route('login'));

        if($request->expectsJson()) {
            return response()->json(['message' =>  $exception->getMessage()],401);
        }

        $guard = Arr::get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            case 'vendor':
                $login = 'vendor.login';
                break;

            default:
                $login = 'user.login';
                break;
        }
        return redirect()->guest(route($login));
    }

}
