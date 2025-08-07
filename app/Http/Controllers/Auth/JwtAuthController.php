<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Interfaces\AuthInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Interfaces\TokenControlInterface;
use App\Http\Requests\UserRegisterRequest;

class JwtAuthController extends Controller
{


    public function __construct(protected AuthInterface $authService, protected TokenControlInterface $tokenControl) {}

    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $result = $this->authService->login($credentials);

        if ($result) {
            return response()->json($result, 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        $result = $this->authService->register($data);

        return response()->json($result, 201);
    }

    public function getUser()
    {
        return response()->json($this->authService->getUser(), 200);
    }
    public function refresh()
    {
        $token = $this->tokenControl->refresh();
        return response()->json(['token' => $token], 200);
    }
    public function tokenData(Request $request)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 400);
        }

        $data = $this->tokenControl->tokenData($token);
        return response()->json($data, 200);
    }
    public function generateToken(Request $request)
    {
        $userData = $request->only('id', 'name', 'email');
        $token = $this->tokenControl->generateToken($userData);
        return response()->json(['token' => $token], 201);
    }
}
