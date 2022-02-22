<?php

namespace App\Http\Controllers\v1\Profile\User;

use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangeLangRequest;
use App\Http\Requests\Profile\User\UserProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    function data(Request $request){
        return new UserResource($request->user());
    }

    function save(UserProfileRequest $request){
        $model = (new MainUpdateAction($request->user(), $request->validated()))->run();

        return new UserResource($model);
    }

    function lang(ChangeLangRequest $request){
        $model = (new MainUpdateAction($request->user(), $request->validated()))->run();

        return new UserResource($model);
    }
}
