<?php

namespace DifferDev\Validations;

use DifferDev\Interfaces\ValidatorInterface;

class IsEven implements ValidatorInterface
{
    public function validate(string|int|float $value): bool
    {
        return !((float)$value % 2);;
    }
}