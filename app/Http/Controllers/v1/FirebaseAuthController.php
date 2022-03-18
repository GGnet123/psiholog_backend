<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirebaseAuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FirebaseAuthController extends Controller
{
    function login(FirebaseAuthRequest $request){
        $auth = app('firebase.auth');
        $idTokenString = $request->input('firebase_token');

        try {
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
        } catch (\InvalidArgumentException $e) {
            return $this->false('Unauthorized - Can\'t parse the token: ' . $e->getMessage());
        } catch (InvalidToken $e) {
            return $this->false('Unauthorized - Token is invalide: ' . $e->getMessage());
        }

        // Retrieve the UID (User ID) from the verified Firebase credential's token
        $uid = $verifiedIdToken->getClaim('sub');

        $user = User::where('firebaseUID', $uid)->first();
        if (!$user){
            $user = new User();
            $user->type_id = User::NOTE_FINISHED_TYPE;
            $user->name = '';
            $user->lang = User::EN_LANG;
            $user->firebaseUID = $uid;
            $user->save();
        }

        Auth::login($user);

        return [
            'data' => new UserResource($user),
            'token' =>  $user->createToken('main')->plainTextToken
        ];
    }

}
