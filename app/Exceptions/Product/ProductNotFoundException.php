<?php

namespace App\Exceptions\Product;

class ProductNotFoundException extends \Exception
{
    public function __construct($ProductId, $code = 204, Exception $previous = null)
    {
        $message = "Product not found: " . $ProductId;
        parent::__construct($message, $code, $previous);
    }
}
