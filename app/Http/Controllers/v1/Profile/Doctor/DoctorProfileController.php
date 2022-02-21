<?php

namespace App\Http\Controllers\v1\Profile\Doctor;

use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;
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
}
