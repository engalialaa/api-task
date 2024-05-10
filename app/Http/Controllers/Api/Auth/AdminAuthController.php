<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
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

        $attemps = $this->authService->adminAttempt($request->username, $request->password);

        return response()->json($attemps, 200);
    }

    public function logout()
    {
        auth('admin')->logout();
        return response()->json(['message' => "Logout", 'code' => 200], 200);
    }
}
