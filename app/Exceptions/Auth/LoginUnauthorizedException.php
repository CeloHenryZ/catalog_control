<?php

namespace App\Exceptions\Auth;

use Exception;

class LoginUnauthorizedException extends Exception
{
    public function __construct($message = 'Unauthorized', $code = 401, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}
