<?php

namespace App\Interfaces;

interface TokenControlInterface
{
    /**
     * Generate a new token for the user.
     *
     * @param array $userData
     * @return string
     */
    public function generateToken(array $userData): string;

    /**
     * Validate the provided token.
     *
     * @param string $token
     * @return bool
     */
    public function validateToken(string $token): bool;

    /**
     * Invalidate the provided token.
     *
     * @param string $token
     * @return void
     */
    public function invalidateToken(string $token): void;

    public function refresh(): string;
    public function tokenData(string $token): array;
}
