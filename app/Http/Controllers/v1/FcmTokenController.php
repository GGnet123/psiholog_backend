<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FcmToken\FcmTokenSaveRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class FcmTokenController extends Controller
{
    function save(FcmTokenSaveRequest $request){
        $data = ['fcm_token' => $request->fcm_token];

        User::where($data)->update(['fcm_token' => null]);
        $request->user()->update($data);

        return new UserResource($request->user());
    }

}
