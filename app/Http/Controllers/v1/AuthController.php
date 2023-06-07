<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\Registration\PhoneNoteFoundedInFirebaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Mail\SendAuthorizationCodeMail;
use App\Mail\SendRegCodeMail;
use App\Models\User;
use App\Services\CheckSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    function login(AuthRequest $request){
        $user = User::where('login', $request->input('login'))->first();
        $isEmailBased = false;
        if (!$user) {
            $user = User::where('email', $request->input('login'))->first();
            $isEmailBased = true;
            if (!$user) {
                return $this->false('Wrong credentials');
            }
        }

        if ($user->is_blocked)
            return $this->false('This user is blocked');

        $code = $request->input('code');
        if (!$code) {
            $pin = rand(100000, 999999);
            $user->login_code = $pin;
            $user->save();
            if ($isEmailBased) {
                try {
                    Mail::to($user->email)->send(new SendAuthorizationCodeMail($user->login_code));
                } catch (\Exception|\Error $exception) {
                    throw new \Exception("System error");
                }
            } else {
                $res_check_pin = CheckSmsService::check($user->login, $user->login_code);
                if (!$res_check_pin) {
                    throw new PhoneNoteFoundedInFirebaseException();
                }
            }

            return ['success' => true];
        }

        if ($user->login_code != $code) {
            throw new \Exception("Wrong code");
        }

        $user->login_code = null;
        $user->save();

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
