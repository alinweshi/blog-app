<?php

namespace App\Services;

use App\Models\User;
use App\Interfaces\AuthInterface;
use App\Interfaces\TokenControlInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthInterface
{
    public function __construct(protected TokenControlInterface $tokenControl) {}

    public function login(array $credentials)
    {
        if ($token = Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            return [
                'user' => $user,
                'token' => $this->tokenControl->respondWithToken($token)
            ];
        }
        return null;
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }

    public function register(array $data)
    {
        $user = User::create($data);
        return [
            'user' => $user,
        ];
    }

    public function getUser()
    {
        return Auth::user();
    }
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
        // dd(Auth::loginUsingId($userData['id']));
        return Auth::loginUsingId($userData['id']);
    }
}
