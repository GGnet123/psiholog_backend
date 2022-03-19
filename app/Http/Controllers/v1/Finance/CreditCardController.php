<?php

namespace App\Http\Controllers\v1\Finance;

use App\Actions\Finance\Check3DSecureAction;
use App\Actions\Finance\CreateCreditCardAction;
use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;;

use App\Http\Requests\Finance\CreateCreditCardRequest;
use App\Http\Resources\Finance\CreditCardResource;
use App\Models\Finance\CreditCard;
use Illuminate\Http\Request;

class CreditCardController extends Controller
{
    function index(Request $request){
        return CreditCardResource::collection(
            CreditCard::where('user_id', $request->user()->id)->latest()->paginate(24)
        );
    }

    function item(Request $request, CreditCard $item){
        if ($request->user()->id != $item->from_user_id)
            abort(403);

        return new CreditCardResource($item);
    }

    function create(CreateCreditCardRequest $request){
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $item = (new CreateCreditCardAction(new CreditCard(), $data))->run();

        return new CreditCardResource($item);
    }

    function remove(CreditCard $item){
        $data = [
            'is_removed' => true,
            'is_active' => false
        ];

        $item = (new MainUpdateAction($item, $data))->run();

        return new CreditCardResource($item);

    }

    function checkSecure(Request $request, CreditCard $item){
        $data = $request->all();

        if ($request->hash != config('cloudpayments.secret_for_check_3d_secure'))
            return 1;


        if (!isset($data['MD']) || !isset($data['PaRes']))
            return 1;

        if ($item->is_accepted)
            return 1;

        $item = (new Check3DSecureAction($item, $data))->run();

        return 1;
    }
}
