<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\Registration\PhoneNoteFoundedInFirebaseException;
use App\Exceptions\Registration\WrongPinException;
use App\Exceptions\RestorePassword\PhoneNoteFoundedInFirebaseForRestoreException;
use App\Exceptions\RestorePassword\WrongPinForRestorePasswordException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Mail\SendAuthorizationCodeMail;
use App\Mail\SendRegCodeMail;
use App\Models\User;
use App\Services\CheckSmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController extends Controller
{
    function login(AuthRequest $request){
        $user = User::where('email', $request->input('login'))->first();
        $isEmailBased = true;
        if (!$user) {
            $user = User::where('login', $request->input('login'))->first();
            $isEmailBased = false;
            if (!$user) {
                return $this->false('Wrong credentials');
            }
        }
        if ($user->login == $user->email) {
            $isEmailBased = true;
        }
        if ($user->is_blocked)
            return $this->false('This user is blocked');

        $code = $request->input('code');
        $sessionInfo = $request->input('sessionInfo');
        if ($isEmailBased && !$code) {
            try {
                $pin = rand(100000, 999999);
                $user->login_code = $pin;
                $user->save();
                Mail::to($user->email)->send(new SendAuthorizationCodeMail($user->login_code));
            } catch (\Exception|\Error $exception) {
                Log::error($exception->getMessage());
                throw new \Exception("System error");
            }
            return ['success' => true];
        }

        if ($isEmailBased && $user->login_code != $code) {
            throw new \Exception("Wrong code");
        } elseif (!$isEmailBased && $sessionInfo) {
            $res_check_pin = CheckSmsService::check($code, $sessionInfo);
            if ($res_check_pin !== true && $res_check_pin == 'wrong_pin')
                throw new WrongPinException();
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
