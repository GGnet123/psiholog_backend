<?php
namespace App\Http\Controllers\Admin\Content;

use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;
use App\Models\Main\TermOfUse as Model;
use Illuminate\Http\Request;

class  TermOfUseController extends Controller{
    protected $view_path = 'page.content.term_of_use';
    protected $route_path = 'admin_term';
    protected $title_path = 'title.admin_term';

    public function index(Request $request){
        $item = Model::firstOrCreate([]);

        $title = __($this->title_path);

        return view($this->view_path.'.index', [
            'title' => $title,
            'ar_bread' => [
                route($this->route_path) => __($this->title_path)
            ],
            'model' => $item,
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function save(Request $request){
        $item = Model::firstOrCreate([]);
        $action = new MainUpdateAction($item, $request->all());

        try {
            $action->run();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', __('main.updated_model'));
    }

}