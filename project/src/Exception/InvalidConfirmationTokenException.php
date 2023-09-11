<?php

namespace App\Exception;

class InvalidConfirmationTokenException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Confirmation token is invalid', $code, $previous);
    }
}