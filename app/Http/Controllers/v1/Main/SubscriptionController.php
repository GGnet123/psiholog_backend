<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\Main\CancelSubscription;
use App\Actions\Main\SaveSubscriptionAction;
use App\Events\ErrorPaySubscriptionEvent;
use App\Events\PaedSubscriptoinEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\SaveSubscriptionRequest;
use App\Http\Resources\Main\SubscriptionResource;
use App\Models\Main\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    function index(Request $request) {
        $item = Subscription::where(['user_id'=>$request->user()->id, 'is_active' => true])->first();

        return $item ? new SubscriptionResource($item) : $this->data_response(null);
    }

    function create(SaveSubscriptionRequest $request) {
        try {
            $item = (new SaveSubscriptionAction(new Subscription(), $request->all()))->run();

            event(new PaedSubscriptoinEvent($item));
        }
        catch (\Exception $exception){
            event(new ErrorPaySubscriptionEvent($request->user()));

            throw $exception;
        }

        return new SubscriptionResource($item);
    }

    function cancelSubscription(Request $request){
        $item = (new CancelSubscription())->run();

        return new SubscriptionResource($item);

    }
}
