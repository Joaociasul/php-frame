<?php

namespace App\Authentication\Jwt;

abstract class AbstractJwt
{
    private array $payload;
    private string $encodedHeader;
    private string $encodedPayload;
    private string $signature;
    protected int $expirationTime;
    private const HEADER = [
        'alg' => 'HS256',
        'typ' => 'JWT',
    ];

    protected function setPayload(int $userId, string $username = '', string $role = '', $expirationTime = 3600, string $serializedClaims = ''): AbstractJwt
    {
        $this->expirationTime = time() + $expirationTime;
        $this->payload = [
            'sub' => $userId,
            'exp' => $this->expirationTime,
            'name' => $username,
            'role' => $role,
            'claims' => $serializedClaims,
        ];
        return $this;
    }

    protected function encodeHeader(): AbstractJwt
    {
        $headerJson = json_encode(self::HEADER);
        $this->encodedHeader = $this->toBase64Url($headerJson);
        return $this;
    }

    protected function encodePayload(): AbstractJwt
    {
        $payloadJson = json_encode($this->payload);
        $this->encodedPayload = $this->toBase64Url($payloadJson);
        return $this;
    }

    protected function generateSignature(): AbstractJwt
    {
        $key = $this->getSecretKey();
        $headerPayloadEncoded = $this->encodedHeader . '.' . $this->encodedPayload;
        $this->signature = $this->toBase64Url(hash_hmac('sha256', $headerPayloadEncoded, $key, true));
        return $this;
    }

    protected function getToken(): string
    {
        return $this->encodedHeader . '.' . $this->encodedPayload . '.' . $this->signature;
    }

    private function toBase64Url(string $subject): string
    {
        $subjectBase64 = base64_encode($subject);
        return str_replace(['+', '/', '='], ['-', '_', ''], $subjectBase64);
    }

    protected function base64DecodeUrl(string $base64Url): string
    {
        return base64_decode(str_replace(['-', '_'], ['+', '/'], $base64Url));
    }

    protected function getSecretKey(): string
    {
        return 'AGfgdfgeRTTY456456$%@!@#tJJYUsedwyWHsdfdfg&&2346587&((8qerweJ';
    }

}