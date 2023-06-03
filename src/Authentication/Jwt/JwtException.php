<?php

namespace App\Authentication\Jwt;

use Exception;

class JwtException extends Exception
{
    /**
     * @throws JwtException
     */
    public static function throwIf(bool $condition, string $message = 'Invalid token!', int $responseCode = 401): void
    {
        if ($condition) {
            http_response_code($responseCode);
            throw new self($message);
        }
    }

}