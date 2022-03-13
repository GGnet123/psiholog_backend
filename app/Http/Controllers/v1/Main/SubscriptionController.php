<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\Main\SaveSubscriptionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\SaveSubscriptionRequest;
use App\Http\Resources\Main\SubscriptionResource;
use App\Models\Main\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    function index(Request $request){
        $item = Subscription::where(['user_id'=>$request->user()->id, 'is_active' => true])->first();

        return $item ? new SubscriptionResource($item) : $this->data_response(null);
    }

    function create(SaveSubscriptionRequest $request){
        $item = (new SaveSubscriptionAction(new Subscription(), $request->all()))->run();

        return new SubscriptionResource($item);
    }
}
