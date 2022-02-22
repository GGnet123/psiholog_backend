<?php

namespace App\Http\Controllers\v1\Profile\Doctor;

use App\Actions\MainDeleteAction;
use App\Actions\MainStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Doctor\DoctorVideoRequest;
use App\Http\Resources\Profile\DoctorVideoResource;
use App\Models\Profile\UserVideo;
use Illuminate\Http\Request;

class DoctorVideoController extends Controller
{
    function index(Request $request){
        $items = UserVideo::where('user_id', $request->user()->id)->latest()->get();

        return  DoctorVideoResource::collection($items);
    }

    function save(DoctorVideoRequest $request){
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $item = (new MainStoreAction(new UserVideo(), $data))->run();

        return new DoctorVideoResource($item);

    }

    function destroy(UserVideo $user_video){
        (new MainDeleteAction($user_video))->run();

        return $this->noContent();
    }
}
