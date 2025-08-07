<?php

namespace App\Services;

use App\Interfaces\TokenControlInterface;
use Illuminate\Support\Facades\Auth;

class TokenControlService implements TokenControlInterface
{
    public function refresh(): string
    {
        return Auth::refresh();
    }

    public function tokenData(string $token): array
    {
        $user = Auth::setToken($token)->user();
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'initials' => $user->initials(),
        ];
    }

    public function generateToken(array $userData): string
    {
        return Auth::loginUsingId($userData['id']);
    }

    public function validateToken(string $token): bool
    {
        return Auth::setToken($token)->check();
    }

    public function invalidateToken(string $token): void
    {
        Auth::invalidate($token);
    }
}
