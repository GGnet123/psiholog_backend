<?php
namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Main\Subscription as Model;
use App\Models\Main\SubscriptionPrices;
use Illuminate\Http\Request;

class SubscriptionController extends Controller{
    protected $view_path = 'page.main.subscription';
    protected $route_path = 'admin_subscription';
    protected $title_path = 'title.admin_subscription';
    protected $def_model = Model::class;

    public function index(Request $request){
        $this->items = $this->def_model::filter($request)->sort($request);

        $prices = SubscriptionPrices::first();

        return view($this->view_path.'.index', [
            'title' => __($this->title_path.''),
            'items' => $this->items->paginate(24),
            'model' => new Model(),
            'request' => $request,
            'route_path' => $this->route_path,
            'prices' => $prices
        ]);
    }

    public function view(Request $request, Model $item){
        $title = __($this->title_path.'_show');

        $data =  [
            'title' => $title,
            'model' => $item,
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.'')
            ],
            'request' => $request,
            'route_path' => $this->route_path
        ];


        return view($this->view_path.'.show', $data);
    }

    public function setPrices(Request $request) {
        $data = $request->all();

        $prices = SubscriptionPrices::first();
        if (!$prices) {
            $prices = new SubscriptionPrices();
        }
        $prices->month_price = $data['month'];
        $prices->year_price = $data['year'];

        return ['success' => $prices->save()];
    }
}
