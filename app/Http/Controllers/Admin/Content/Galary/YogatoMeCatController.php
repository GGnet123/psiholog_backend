<?php
namespace App\Http\Controllers\Admin\Content\Galary;

use App\Actions\AbstractAction;
use App\Actions\MainDeleteAction;
use App\Actions\MainStoreAction;
use App\Actions\MainUpdateAction;
use App\Http\Controllers\Controller;
use App\Models\Content\MainGalary;
use App\Models\Content\MainGalaryCat as Model;
use Illuminate\Http\Request;

class  YogatoMeCatController extends Controller{
    protected $view_path = 'page.content.galary.yoga_cat';
    protected $route_path = 'yoga_cat';
    protected $title_path = 'title.yoga_cat';
    protected $def_model = Model::class;
    protected $type = MainGalary::TYPE_YOGA_TO_ME;

    public function index(Request $request){
        $this->items = $this->def_model::where('type', $this->type)->filter($request)->sort($request);

        return view($this->view_path.'.index', [
            'title' => __($this->title_path.''),
            'items' => $this->items->paginate(24),
            'model' => new Model(),
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function create(Request $request, Model $item){

        return view($this->view_path.'.create', [
            'title' => __($this->title_path.'_create'),
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.'')
            ],
            'model' => new Model(),
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function saveCreate(Request $request, Model $item){
        $data = $request->all();
        $data['type'] = $this->type;

        $action = new MainStoreAction($item, $data);

        try {
            $action->run();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route($this->route_path)->with('success', __('main.created_model'));
    }

    public function view(Request $request, Model $item){
        $title = __($this->title_path.'_show');

        return view($this->view_path.'.show', [
            'title' => $title,
            'model' => $item,
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.'')
            ],
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function update(Request $request, Model $item){
        $title = __($this->title_path.'_update');

        return view($this->view_path.'.update', [
            'title' => $title,
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.''),
                route($this->route_path.'_show', $item) => __($this->title_path.'_show'),
            ],
            'model' => $item,
            'request' => $request,
            'route_path' => $this->route_path
        ]);
    }

    public function saveUpdate(Request $request, Model $item){
        $action = new MainUpdateAction($item, $request->all());

        try {
            $action->run();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route($this->route_path.'_show', $item)->with('success', __('main.updated_model'));
    }

    public function delete(Request $request, Model $item){
        $action = new MainDeleteAction($item);
        $action->run();

        return redirect()->route($this->route_path)->with('success', __('main.deleted_model'));
    }
}
