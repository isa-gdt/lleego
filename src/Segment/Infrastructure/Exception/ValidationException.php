<?php

declare(strict_types=1);

namespace App\Segment\Infrastructure\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidationException extends HttpException
{
    protected const MESSAGE = 'Validation error';
    protected const CODE = 400;

    public function __construct(
        private readonly array $errors
    )
    {
        parent::__construct(self::CODE, self::MESSAGE);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}