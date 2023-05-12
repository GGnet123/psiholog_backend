<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    const AUTH_TYPE_EMAIL = 'email';
    const AUTH_TYPE_PHONE = 'phone';
    function login(AuthRequest $request){
        $type = $request->input('type', self::AUTH_TYPE_PHONE);
        if (!Auth::attempt([($type == self::AUTH_TYPE_PHONE ? 'login'  : 'email') => $request->input('login') , 'password' => $request->input('password')]) )
            return $this->false('Wrong credentials');

        $user = Auth::user();
        //$user->tokens()->delete();

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
