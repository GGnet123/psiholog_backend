<?php

namespace App\Http\Controllers\v1;

use App\Actions\CreatePassword\CheckLoginAction;
use App\Actions\CreatePassword\SaveAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePassword\CheckLoginRequest;
use App\Http\Requests\CreatePassword\SaveRequest;
use App\Http\Resources\UserResource;

class CreatePasswordController extends Controller
{
    function save(SaveRequest $request){
        $model = (new SaveAction($request->user(), $request->validated()))->run();

        return new UserResource($model);
    }

    function checkLogin(CheckLoginRequest $request){
        $model = (new CheckLoginAction($request->user(), $request->validated()))->run();

        return $this->data_response(true);
    }

}
