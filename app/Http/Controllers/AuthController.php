<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

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

}
