<?php
namespace App\Http\Controllers\v1;

use App\Actions\RestorePassword\Step1Action;
use App\Actions\RestorePassword\Step2Action;
use App\Actions\RestorePassword\Step3Action;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestorePassword\Step1Request;
use App\Http\Requests\RestorePassword\Step2Request;
use App\Http\Requests\RestorePassword\Step3Request;

class  RestorePasswordController extends Controller {
    function step1(Step1Request $request){
        $res = (new Step1Action(null, $request->validated()))->run();

        return [
            'success' => true,
            'login' => $request->login
        ];
    }

    function step2(Step2Request $request){
        $res = (new Step2Action(null, $request->validated()))->run();

        return [
            'success' => true,
            'login' => $request->login
        ];
    }

    function step3(Step3Request $request){
        $res = (new Step3Action(null, $request->validated()))->run();

        return [
            'success' => true,
            'login' => $request->login,
            'password' => $request->password
        ];
    }
}