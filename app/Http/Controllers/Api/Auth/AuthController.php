<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {
    }


    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $attemps = $this->authService->userAttempt($request->username, $request->password);

        return response()->json($attemps, 200);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth('web')->logout();
        return response()->json(['message' => "Logout", 'code' => 200], 200);
    }
}
