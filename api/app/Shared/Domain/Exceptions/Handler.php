<?php

namespace App\Shared\Domain\Exceptions;

use Dotenv\Exception\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Shared\Domain\Exceptions\ProductNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        
    ];

    public function register(): void
    {

        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Item Not Found'], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'unAuthenticated'], Response::HTTP_UNAUTHORIZED);
            }
        });
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'UnprocessableEntity', 'errors' => []], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'The requested link does not exist'], Response::HTTP_BAD_REQUEST);
            }
        });

        $this->renderable(function (ProductNotFoundException $e, $request) {
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
            }
        });

    }
}
