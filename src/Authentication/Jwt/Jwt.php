<?php

namespace App\Authentication\Jwt;

class Jwt extends AbstractJwt
{
    public static function make(int $userId, string $username = '', string $role = '', $expirationTime = 3600, string $claims = ''): array
    {
        $instance = new self();
        $token = $instance->setPayload($userId, $username, $role, $expirationTime, $claims)
            ->encodeHeader()
            ->encodePayload()
            ->generateSignature()
            ->getToken();
        return [
            'token' => $token,
            'expires_in' => $instance->expirationTime,
        ];
    }


    /**
     * @throws JwtException
     */
    public static function verify(string $token): void
    {
        $instance = new self();
        [$header, $payload, $signature] = explode('.', $token);
        $headerObj = json_decode($instance->base64DecodeUrl($header));
        $payloadObj = json_decode($instance->base64DecodeUrl($payload));
        JwtException::throwIf(
            ! $headerObj ||
            ! $payloadObj ||
            $headerObj->alg !== 'HS256' ||
            $headerObj->typ !== 'JWT' ||
            ! isset($payloadObj->sub) ||
            ! isset($payloadObj->name) ||
            ! isset($payloadObj->role) ||
            ! isset($payloadObj->exp) ||
            $payloadObj->exp < time()
        );
        $signatureBin = $instance->base64DecodeUrl($signature);
        $key = $instance->getSecretKey();
        $headerPayload = $header . '.' . $payload;
        $newSignature = hash_hmac('sha256', $headerPayload, $key, true);
        JwtException::throwIf(! hash_equals($signatureBin, $newSignature));
    }
}