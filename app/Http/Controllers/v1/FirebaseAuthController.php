<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirebaseAuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\CheckFirebaseAuthProviderService;
use Illuminate\Support\Facades\Auth;

class FirebaseAuthController extends Controller
{

    function login(FirebaseAuthRequest $request){
        $id = CheckFirebaseAuthProviderService::check($request->firebase_token, $request->firebase_provider);
        if (!$id)
            return $this->false('Wrong credentials');

        $user = User::where(['firebaseUID' => $id, 'firebaseProvider' => $request->firebase_provider])->first();
        if (!$user){
            $user = new User();
            $user->type_id = User::NOTE_FINISHED_TYPE;
            $user->name = '';
            $user->login = '';
            $user->password = '';
            $user->lang = User::EN_LANG;
            $user->firebaseUID = $id;
            $user->firebaseProvider = $request->firebase_provider;
            $user->save();
        }

        Auth::login($user);

        return [
            'data' => new UserResource($user),
            'token' =>  $user->createToken('main')->plainTextToken
        ];
    }

}
