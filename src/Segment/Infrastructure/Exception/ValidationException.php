<?php

declare(strict_types=1);

namespace App\Segment\Infrastructure\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidationException extends BadRequestHttpException
{
    protected const MESSAGE = 'Validation error';

    public function __construct(
        private readonly array $errors
    )
    {
        parent::__construct(self::MESSAGE);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}