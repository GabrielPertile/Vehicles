<?php

namespace App\Exceptions;

use App\Libraries\Translator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Contracts\Filesystem\FileNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
    ];

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // TODO colocar translator para retorno de mensagens
    public function render($request, Exception|Throwable $e)
    {
        $translator = new Translator();

        // content-type: json
        if ($request->expectsJson()) {
            switch (true) {
                case $e instanceof MethodNotAllowedHttpException:
                    $message = '';
                    if (str_contains($e->getMessage(), 'method is not supported')) {
                        $message = $translator->translate('exception.method_is_not_supported');
                    } else if (is_null($e->getMessage())) {
                        $message = $e->getMessage();
                    } else {
                        $message = $e->getMessage();
                    }
                    return response()->json([
                        'data' => [
                            'message' => $message,
                        ],
                    ], Response::HTTP_NOT_FOUND);
                    break;

                case $e instanceof NotFoundHttpException:
                    return response()->json([
                        'data' => [
                            'message' => $translator->translate('exception.action_not_found'),
                        ],
                    ], Response::HTTP_NOT_FOUND);

                    break;

                case $e instanceof ValidationException:
                    return response()->json([
                        'data' => [
                            'message' => $translator->translate('validation.validation_exception.invalid'),
                            'errors' => $e->errors(),
                        ],
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);

                    break;

                case $e instanceof TypeError:
                    return response()->json([
                        'data' => [
                            'message' => $translator->translate('exception.invalid_type'),
                        ],
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                    break;

                case $e instanceof ModelNotFoundException:
                    $message = $translator->translate('exception.no_query_results');
                    return response()->json([
                        'data' => [
                            'message' => $message,
                        ],
                    ], Response::HTTP_NOT_FOUND);
                    break;

                case $e instanceof Exception:
                    $message = '';
                    if (str_contains($e->getMessage(), 'HTTP_INTERNAL_SERVER_ERROR')) {
                        return response()->json([
                            'data' => [
                                'message' => $translator->translate('exception.http_internal_server_error'),
                            ],
                        ], Response::HTTP_INTERNAL_SERVER_ERROR);
                    } else
                if (str_contains($e->getMessage(), 'exception.')) {
                        $message = $translator->translate($e->getMessage());
                    } else
                if (str_contains($e->getMessage(), 'No query results for')) {
                        $message = $translator->translate('exception.no_query_results');
                    } else
                if (str_contains($e->getMessage(), 'SQLSTATE')) {
                        $message = $translator->translate('exception.database_error');
                    } else {
                        $message = $e->getMessage();
                    }
                    return response()->json([
                        'data' => [
                            'message' => !str_contains($message, ' CPF ') && !str_contains($message, ' cadastro ') ? $message : "Ops! Algumas informações estão erradas, por favor conferir.",
                            'errors' => (str_contains($message, ' CPF ') ? ['cpf' => [$message]] : (str_contains($message, ' cadastro ') ? ['email' => [$message]] : []))
                        ],
                    ], Response::HTTP_NOT_FOUND);
            }
        }

        return parent::render($request, $e);
    }
}
