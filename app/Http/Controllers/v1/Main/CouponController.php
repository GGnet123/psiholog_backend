<?php

namespace App\Http\Controllers\v1\Main;

use App\Actions\Main\BuyCouponAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\BuyCouponRequest;
use App\Models\Main\Coupon;
use Google\Cloud\Core\Exception\NotFoundException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CouponController extends Controller
{
    function checkCoupon($code) {
        $coupon = Coupon::where('code', $code)->first();
        if (!$coupon) {
            throw new NotFoundHttpException('Coupon not found');
        }
        return $coupon;
    }
    function getUserCoupons() {
        $user = Auth::user();
        $coupons = Coupon::where('created_user_id', $user->id)->get();

        return $coupons;
    }

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
