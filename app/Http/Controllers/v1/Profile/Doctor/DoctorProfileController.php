<?php

namespace App\Http\Controllers\v1\Profile\Doctor;

use App\Actions\MainUpdateAction;
use App\Actions\Profile\ChangePasswordAction;
use App\Actions\Profile\CheckPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangeLangRequest;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\CheckPasswordRequest;
use App\Http\Requests\Profile\Doctor\DoctorProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class DoctorProfileController extends Controller
{
    function data(Request $request){
        return new UserResource($request->user());
    }

    function save(DoctorProfileRequest $request){
        $model = (new MainUpdateAction($request->user(), $request->validated()))->run();

        return new UserResource($model);
    }

    function lang(ChangeLangRequest $request){
        $model = (new MainUpdateAction($request->user(), $request->validated()))->run();

        return new UserResource($model);
    }

    function checkOldPassword(CheckPasswordRequest $request){
        $bool = (new CheckPasswordAction($request->user(), $request->validated()))->run();
        return response()->json([
            'success' => $bool
        ]);
    }

    function changePassword(ChangePasswordRequest $request){
        $model = (new ChangePasswordAction($request->user(), $request->validated()))->run();

        return new UserResource($model);
    }
}
