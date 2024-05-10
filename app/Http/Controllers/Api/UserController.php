<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private  readonly UserService $userService
    )
    {
    }

    public function userLookups(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->userService->getUserNameAndId());
    }
}
