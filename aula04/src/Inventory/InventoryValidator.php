<?php

namespace DifferDev\Inventory;

use DifferDev\Validations\Validator;

class InventoryValidator
{
    private $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validatePieces(array $item)
    {
        $piecesValid = $this->validator->validate($item['pieces']);
        if (!$piecesValid) {
            return ['error' => 'Invalid pieces'];
        }

        return $item; 
    }
    
    public function validateQuantity(array $item)
    {
        $quantityValid = $this->validator->validate($item['quantity']);
        if (!$quantityValid) {
            return ['error' => 'Invalid quantity'];
        }

        return $item; 
    }
}