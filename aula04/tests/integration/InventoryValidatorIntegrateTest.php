<?php

use DifferDev\Inventory\InventoryValidator;
use DifferDev\Validations\IsEven;
use DifferDev\Validations\IsGreaterThan;
use DifferDev\Validations\IsInteger;
use DifferDev\Validations\Validator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(InventoryValidator::class)]
class InventoryValidatorIntegrateTest extends \PHPUnit\Framework\TestCase
{
    #[DataProvider('positiveInventoryDataProvider')]
    public function testPositiveInventoryItemPiecesShouldBeSuccessful(array $item)
    {
        $validators = [
            new IsInteger(),
            new IsGreaterThan(1),
            new IsEven()
        ];
        $validator = new Validator($validators);
        $inventoryvalidaton = new InventoryValidator($validator);

        $result = $inventoryvalidaton->validatePieces($item);

        $this->assertEquals($item, $result);
    }

    #[DataProvider('negativeInventoryDataProvider')]
    public function testNegativeInventoryItemPiecesShouldFail(array $item)
    {
        $validators = [
            new IsInteger(), 
            new IsGreaterThan(1),
            new IsEven(),
        ];
    
        $validator = new Validator($validators);
        $inventoryvalidaton = new InventoryValidator($validator);
    
        $result = $inventoryvalidaton->validatePieces($item);
    
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Invalid pieces', $result['error']);
    }

    #[DataProvider('positiveInventoryDataProvider')]
    public function testPositiveInventoryItemQuantityShouldBeSuccessful(array $item)
    {
        $validators = [
            new IsInteger(),
            new IsGreaterThan(0),
            new IsEven
        ];
    
        $validator = new Validator($validators);
        $inventoryvalidaton = new InventoryValidator($validator);
    
        $result = $inventoryvalidaton->validateQuantity($item);
    
        $this->assertEquals($item, $result);
    }

    #[DataProvider('negativeInventoryDataProvider')]
    public function testNegativeInventoryItemQuantityShouldFail(array $item)
    {
        $validators = [
            new IsGreaterThan(0),
        ];
    
        $validator = new Validator($validators);
        $inventoryvalidaton = new InventoryValidator($validator);
    
        $result = $inventoryvalidaton->validateQuantity($item);
    
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Invalid quantity', $result['error']);
    }

    public static function positiveInventoryDataProvider()
    {
        return [
            [
                [
                    'id' => 1303,
                    'name' => 'Shoes',
                    'category' => 'footwear',
                    'quantity' => 8,
                    'price' => '87.00',
                    'currency' => 'USD',
                    'pieces' => 2,
                ],
                true,
            ],
            [
                [
                    'id' => 2037,
                    'name' => 'Boots',
                    'category' => 'footwear',
                    'quantity' => 12,
                    'price' => '120.00',
                    'currency' => 'USD',
                    'pieces' => 2,
                ],
                true,
            ],
            [
                [
                    'id' => 1105,
                    'name' => 'Slippers',
                    'category' => 'footwear',
                    'quantity' => 10,
                    'price' => '50.00',
                    'currency' => 'USD',
                    'pieces' => 2,
                ],
                true,
            ],
        ];
    }

    public static function negativeInventoryDataProvider()
    {
        return [
            [
                [
                    'id' => 1303,
                    'name' => 'Shoes',
                    'category' => 'footwear',
                    'quantity' => 0,
                    'price' => '87.00',
                    'currency' => 'USD',
                    'pieces' => 7,
                ],
                false,
            ],
            [
                [
                    'id' => 2037,
                    'name' => 'Boots',
                    'category' => 'footwear',
                    'quantity' => -1,
                    'price' => 0,
                    'currency' => 'USD',
                    'pieces' => 3,
                ],
                false,
            ],
            [
                [
                    'id' => 2045,
                    'name' => 'Slippers',
                    'category' => 'footwear',
                    'quantity' => 0,
                    'price' => '50.00',
                    'currency' => 'USD',
                    'pieces' => 5,
                ],
                false,
            ],
        ];
    }
}
