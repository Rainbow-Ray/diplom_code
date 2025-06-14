<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\QueryException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */

    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {
        // });


        $this->renderable(function (HttpException $e, $request) {
            // return $e->getStatusCode();
            // return $e->getStatusCode() == '403';
            if($e->getStatusCode() == '403'){
            return response()->view('error', ['request' => $request, 'message' => "Ошибка 403. У вас нет прав для доступа к данной странице."]);

            }
            return response()->view('error', ['request' => $request, 'message' => "Произошла ошибка. Вернитесь на предыдущую страницу"]);
        });


        $this->renderable(function (ErrorException $e, $request) {
            return response()->view('error', ['request' => $request, 'message' => "ERROR"]);
        });

        $this->renderable(function (QueryException $e,  $request) {
            return back()->withErrors(['err' => 'Невозможно удалить, на данную запись ссылаются другие объекты']);
        });

        // $this->renderable(function (Exception $e, $request) {
        //     return response() -> view('error', ['request'=> $request, 'message'=>"Произошла ошибка. Вернитесь на предыдущую страницу"]);
        // });
        // AuthorizationException

    }
}
