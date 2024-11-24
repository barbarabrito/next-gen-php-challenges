<?php

namespace DifferDev\Interfaces;

interface ValidatorInterface
{
    public function validate(string|int|float $value): bool;
}
