<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\MainStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\SaveClaimRequest;
use App\Http\Resources\Main\ClaimResource;
use App\Models\Main\Claim;
use App\Notifications\NewClaimNotifications;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    function index(Request $request){
        return ClaimResource::collection(
            Claim::where('from_user_id', $request->user()->id)->latest()->paginate(24)
        );
    }

    function item(Request $request, Claim $item){
        if ($request->user()->id != $item->from_user_id)
            abort(403);

        return new ClaimResource($item);
    }

    function save(SaveClaimRequest $request){
        $data = $request->validated();
        $data['from_user_id'] = $request->user()->id;
        $item = (new MainStoreAction(new Claim(), $data))->run();
        $item->notify(new NewClaimNotifications());

        return new ClaimResource($item);
    }
}
