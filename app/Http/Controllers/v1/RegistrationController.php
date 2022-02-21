<?php

namespace App\Http\Controllers\v1;

use App\Actions\Registration\ResendPinAction;
use App\Actions\Registration\Step1Action;
use App\Actions\Registration\Step2Action;
use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\Step1Request;
use App\Http\Requests\Registration\Step2Request;
use App\Http\Resources\Registration\PhoneRegistrationResource;
use App\Http\Resources\UserResource;

class RegistrationController extends Controller
{
    function step1(Step1Request $request){
        $model = (new Step1Action(null, $request->validated()))->run();

        return new PhoneRegistrationResource($model);
    }

    function resendPin(Step1Request $request){
        $model = (new ResendPinAction(null, $request->validated()))->run();

        return new PhoneRegistrationResource($model);
    }

    function step2(Step2Request $request){
        $model = (new Step2Action(null, $request->validated()))->run();

        return new UserResource($model);
    }

    function step3(){

    }

}
