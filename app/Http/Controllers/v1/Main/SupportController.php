<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\MainStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\StoreSupportRequest;
use App\Http\Resources\Main\SupportResource;
use App\Models\Main\Support;
use App\Notifications\NewSupportMessageNotifications;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    function index(Request $request){
        return SupportResource::collection(
            Support::where('from_user_id', $request->user()->id)->latest()->paginate(12)
        );
    }

    function save(StoreSupportRequest $request){
        $data = $request->validated();
        $data['from_user_id'] = $request->user()->id;
        $data['is_closed'] = false;

        $model = (new MainStoreAction(new Support(), $data))->run();
        $model->notify(new NewSupportMessageNotifications());

        return new SupportResource($model);
    }

    function item(Support $item){
        return new SupportResource($item);
    }
}
