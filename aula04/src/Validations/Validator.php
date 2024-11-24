<?php
declare(strict_types=1);

namespace DifferDev\Validations;

use DifferDev\Interfaces\ValidatorInterface;

class Validator implements ValidatorInterface
{
    protected array $validators;

    public function __construct(array $config)
    {
        $this->validators = $config;
    }

    public function validate(string|int|float $value): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($value)) {
                return false;
            }
        }
        return true;
    }
}
