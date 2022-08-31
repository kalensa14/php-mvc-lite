<?php

namespace App\Exceptions;

class ValidationException extends \RuntimeException
{
    private array $errors;

    public function __construct(string $message, array $errors)
    {
        $this->errors = $errors;

        parent::__construct($message, 400);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}