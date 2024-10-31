<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Authenticate
 * @package App\Shared\Http\Middleware
 */
class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @param array<string> $guards
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function unauthenticated($request, array $guards): void 
    {
        throw new HttpResponseException(
            response()->json(['message' => 'Unauthenticated.'], Response::HTTP_UNAUTHORIZED)
        );
    }
}



