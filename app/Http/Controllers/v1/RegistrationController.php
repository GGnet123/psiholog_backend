<?php

namespace App\Http\Controllers\v1;

use App\Actions\Registration\Step1Action;
use App\Actions\Registration\Step1EmailAction;
use App\Actions\Registration\Step2Action;
use App\Actions\Registration\Step2EmailAction;
use App\Actions\Registration\Step3DoctorAction;
use App\Actions\Registration\Step3UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\Step1Request;
use App\Http\Requests\Registration\Step1EmailRequest;
use App\Http\Requests\Registration\Step2Request;
use App\Http\Requests\Registration\Step2EmailRequest;
use App\Http\Requests\Registration\Step3DoctorRequest;
use App\Http\Requests\Registration\Step3UserRequest;
use App\Http\Resources\Registration\PhoneRegistrationResource;
use App\Http\Resources\Registration\EmailRegistrationResource;
use App\Http\Resources\UserResource;

class RegistrationController extends Controller
{
    function step1(Step1Request $request) {
        $model = (new Step1Action(null, $request->validated()))->run();

        return new PhoneRegistrationResource($model);
    }

    function step1Email(Step1EmailRequest $request) {
        $model = (new Step1EmailAction(null, $request->validated()))->run();

        return new EmailRegistrationResource($model);
    }

    function step2(Step2Request $request){
        $user = (new Step2Action(null, $request->validated()))->run();

        return [
            'data' => new UserResource($user),
            'token' =>  $user->createToken('main')->plainTextToken
        ];
    }

    function step2Email(Step2EmailRequest $request) {
        $user = (new Step2EmailAction(null, $request->validated()))->run();

        return [
            'data' => new UserResource($user),
            'token' =>  $user->createToken('main')->plainTextToken
        ];
    }

    function step3Doctor(Step3DoctorRequest $request): UserResource
    {
        $user = $request->user();
        $user = (new Step3DoctorAction($user, $request->validated()))->run();

        return new UserResource($user);
    }

    function step3User(Step3UserRequest $request): UserResource
    {
        $user = $request->user();
        $user = (new Step3UserAction($user, $request->validated()))->run();

        return new UserResource($user);
    }

}
