<?php

namespace DifferDev\Validations;

use DifferDev\Interfaces\ValidatorInterface;

class IsGreaterThan implements ValidatorInterface
{
    public function __construct(
        public float|string $compared
    ) {
    }
    
    public function validate(string|int|float $value): bool
    {
        return $value > $this->compared;;
    }
}
