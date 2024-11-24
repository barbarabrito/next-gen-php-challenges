<?php

namespace DifferDev\Validations;

use DifferDev\Interfaces\ValidatorInterface;

class IsInteger implements ValidatorInterface
{
    public function validateFloat(string $floatValue): bool
    {
        // Regex que valida se é string com número quebrado '3.4'
        return (bool)preg_match('/^\d+\.\d+([eE][+-]?\d+)?$/', $floatValue);
    }

    public function validate(string|int|float $value): bool
    {
        return $this->validateFloat($value) === false;
    }
}