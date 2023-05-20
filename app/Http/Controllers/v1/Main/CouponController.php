<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\Main\BuyCouponAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\BuyCouponRequest;
use App\Models\Main\Coupon;

class CouponController extends Controller
{
    function buy(BuyCouponRequest $request) {
        $action = new BuyCouponAction(new Coupon(), $request->validated());
        try {
            $code = $action->run();
            return ['success' => true, 'code' => $code];
        } catch (\Exception $exception) {
            return ['success' => false, 'error' => $exception->getMessage()];
        }
    }
}
