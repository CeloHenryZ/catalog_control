<?php

namespace App\Exceptions\Category;

use Exception;

class CategoryNotFoundException extends Exception
{
    public function __construct($categoryId, $code = 204, Exception $previous = null)
    {
        $message = "Category not found: " . $categoryId;
        parent::__construct($message, $code, $previous);
    }
}
