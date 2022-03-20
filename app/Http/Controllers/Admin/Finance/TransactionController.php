<?php
namespace App\Http\Controllers\Admin\Finance;

use App\Actions\Finance\CancelTransactionAction;
use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;
use App\Models\Finance\CardTransaction as Model;
use Illuminate\Http\Request;

class  TransactionController extends Controller{
    protected $view_path = 'page.finance.transaction';
    protected $route_path = 'admin_transaction';
    protected $title_path = 'title.admin_transaction';
    protected $def_model = Model::class;

    public function index(Request $request){
        $this->items = $this->def_model::filter($request)->sort($request);

        return view($this->view_path.'.index', [
            'title' => __($this->title_path.''),
            'items' => $this->items->paginate(24),
            'model' => new Model(),
            'request' => $request,
            'route_path' => $this->route_path
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

    public function cancel(Request $request, Model $item){
        $action = new CancelTransactionAction($item, []);
        try {
            $action->run();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', __('main.updated_model'));
    }

}
