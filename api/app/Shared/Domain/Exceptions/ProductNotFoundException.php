<?php

namespace App\Shared\Domain\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ProductNotFoundException extends HttpException
{
    public function __construct(string $message = "Product not found", int $statusCode = Response::HTTP_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($statusCode, $message, $previous);
    }
}