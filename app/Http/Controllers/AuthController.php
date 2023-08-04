<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $validated = $request->validated();

        $authService = new AuthService();
        $response = $authService->register($validated);
       
        return response($response, 201);
    }

    public function login(LoginUserRequest $request){
        $validated = $request->validated();

        $authService = new AuthService();
        $response = $authService->login($validated);

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return ['message' => 'Logged out'];
    }
}
