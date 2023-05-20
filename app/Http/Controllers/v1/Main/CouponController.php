<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\Main\BuyCouponAction;
use App\Exceptions\Finance\UserNotHasActiveCreditCardException;
use App\Http\Controllers\Controller;
use App\Models\Main\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    function buy(Request $request) {
        $action = new BuyCouponAction(new Coupon(), ['sum' => $request->post('sum')]);
        try {
            $code = $action->run();
            return ['success' => true, 'code' => $code];
        } catch (\Exception $exception) {
            return ['success' => false, 'error' => $exception->getMessage()];
        }
    }
}
