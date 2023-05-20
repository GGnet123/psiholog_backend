<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Main\Coupon as Model;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $view_path = 'page.main.coupons';
    protected $route_path = 'admin_coupons';
    protected $title_path = 'title.coupons';
    protected $def_model = Model::class;
    public function index(Request $request) {
        $this->items = $this->def_model::filter($request)->sort($request);

        return view($this->view_path.'.index', [
            'title' => __($this->title_path.''),
            'items' => $this->items->paginate(24),
            'model' => new Model(),
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function create(Request $request, Model $item){
        $code = Model::generateCode();
        $model = new Model();
        $model->code = $code;
        return view($this->view_path.'.create', [
            'title' => __($this->title_path.'_create'),
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.'')
            ],
            'model' => $model,
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function saveCreate(Request $request) {
        $code = $request->post('code');
        $sum = $request->post('sum');
        $coupon = Model::where('code', $code)->first();
        if ($coupon) {
            return redirect()->back()->with('error', 'Code is already created, try again');
        }
        $newCoupon = new Model();
        $newCoupon->code = $code;
        $newCoupon->sum = $sum;
        $newCoupon->is_used = false;

        if ($newCoupon->save()) {
            return redirect()->route($this->route_path)->with('success', __('main.created_model'));
        }
        return redirect()->back()->with('error', 'Failed to create a coupon');
    }

    public function delete(Request $request, Model $item){
        Model::destroy([$item->id]);

        return redirect()->route($this->route_path)->with('success', __('main.deleted_model'));
    }
}
