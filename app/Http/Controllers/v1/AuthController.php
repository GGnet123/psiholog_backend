<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(AuthRequest $request){
        if (!Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password')]) )
            return $this->false('Wrong credentials');

        $user = Auth::user();
        $user->tokens()->delete();

        if ($user->is_blocked)
            return $this->false('This user is blocked');

        return [
            'data' => new UserResource($user),
            'token' =>  $user->createToken('main')->plainTextToken
        ];
    }

    function logout(Request $request){
        $request->user()->tokens()->delete();

        return $this->noContent();
    }
}
