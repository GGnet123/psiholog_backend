<?php
namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Models\Profile\UserCertificat;
use App\Models\Main\Support as Model;
use Illuminate\Http\Request;

class  SupportController extends Controller{
    protected $view_path = 'page.main.support';
    protected $route_path = 'admin_support';
    protected $title_path = 'title.admin_support';
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

}
