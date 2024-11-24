<?php

use DifferDev\Validations\IsEven;
use DifferDev\Validations\IsGreaterThan;
use DifferDev\Validations\IsInteger;
use DifferDev\Validations\Validator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Validator::class)]
final class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testClassValidatorShouldValidateIsInteger(): void
    {
        $validation = new Validator([new IsInteger()]);

        $this->assertTrue($validation->validate('1'));
        $this->assertTrue($validation->validate('-2'));
    }

    public function testClassValidatorShouldValidateIsNotInteger(): void
    {
        $validation = new Validator([new IsInteger()]);

        $this->assertFalse($validation->validate('123.22'));
    }

    public function testClassValidatorShouldValidateMultipleValidations(): void
    {
        $value = '302';

        $validation1 = new Validator([new IsInteger()]);
        $validation2 = new Validator([new IsGreaterThan(300)]);
        $validation3 = new Validator([new IsEven()]);

        $result1 = $validation1->validate($value);
        $result2 = $validation2->validate($value);
        $result3 = $validation3->validate($value);

        $this->assertTrue($result1 && $result2 && $result3);
    }

    public function testClassValidatorShouldAggregateMultipleValidations(): void
    {
        $validators = [
            new IsInteger(),
            new IsGreaterThan(200),
            new IsEven()
        ];

        $validationGroup = new Validator($validators);
        $result = $validationGroup->validate('304');  

        $this->assertTrue($result);
    }
}
