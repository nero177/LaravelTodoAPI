<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthService{
    public function register($data){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('apptoken')->plainTextToken;
        
        return ['token' => $token];
    }
    
    public function login($data){
        //check email
        $user = User::where('email', $data['email'])->first();

        //check password
        if(!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('apptoken')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }   
}