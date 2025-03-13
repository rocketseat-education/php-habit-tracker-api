<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(RegisterRequest $r) 
    {

        $user = User::create([

            'name' => $r->string('name'),
            'email' => $r->string('email'),
            'password' => $r->string('password')

        ]);

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);

    }

    public function login(LoginRequest $r)
    {

        $user = User::firstWhere('email', $r->string('email'));

        if (!$user || !Hash::check($r->string('password'), $user->password)) {

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrent.']
            ]);

        }

        $user->tokens()->delete();

        return [

            'token' => $user->createToken('auth_token')->plainTextToken

        ];

    }

}
