<?php

namespace App\Exception;

use ApiPlatform\Exception\ExceptionInterface;

class EmptyBodyException extends \Exception implements ExceptionInterface
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('The body of the POST/PUT method cannot be empty', $code, $previous);
    }
}