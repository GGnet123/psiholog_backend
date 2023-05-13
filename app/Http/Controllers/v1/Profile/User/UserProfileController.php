<?php

namespace App\Http\Controllers\v1\Profile\User;

use App\Actions\MainUpdateAction;
use App\Actions\Profile\ChangePasswordAction;
use App\Actions\Profile\CheckPasswordAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ChangeLangRequest;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Http\Requests\Profile\CheckPasswordRequest;
use App\Http\Requests\Profile\User\UserProfileRequest;
use App\Http\Requests\Profile\ChangePhoneRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    function data(Request $request){
        return new UserResource($request->user());
    }
	
	function changePhone(ChangePhoneRequest $request){
		if (User::where('login', $request->login)->where('id', '<>', $request->user())->count() > 0)
			return $this->false('Текуший логин уже используется');
		
		$request->user()->update(['login'=> $request->login]);
		
		return true;
	}

    function save(UserProfileRequest $request){
			
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
