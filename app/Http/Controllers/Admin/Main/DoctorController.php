<?php
namespace App\Http\Controllers\Admin\Main;

use App\Events\UserIsBlockedEvent;
use App\Http\Controllers\Controller;
use App\Models\Profile\UserCertificat;
use App\Models\User as Model;
use Illuminate\Http\Request;

class  DoctorController extends Controller{
    protected $view_path = 'page.main.doctor';
    protected $route_path = 'admin_doctor';
    protected $title_path = 'title.doctor';
    protected $def_model = Model::class;

    public function index(Request $request){
        $this->items = $this->def_model::doctor()->filter($request)->sort($request);

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
            'route_path' => $this->route_path,
            'specializations' => $item->relSpecilizationMain()->pluck('name')->toArray(),
            'certificats' => $item->relCertificatsMain,
            'videos' => $item->relVideoMain,
            'timetable' => $item->relTimetablePlan
        ];


        return view($this->view_path.'.show', $data);
    }

    function blocked(Request $request, Model $item){
        $item->update(['is_blocked' => ($item->is_blocked ? false : true)]);

        return redirect()->back()->with('success', __('main.updated_model'));
    }

    function blockedSeance(Request $request, Model $item){
        $item->update(['is_blocked_seance' => ($item->is_blocked_seance ? false : true)]);

        if ($item->is_blocked_seance)
            event(new UserIsBlockedEvent($item));

        return redirect()->back()->with('success', __('main.updated_model'));
    }



    function approveDoctor(Request $request, Model $item){
        $item->update(['is_doctor_approve' => ($item->is_doctor_approve ? false : true)]);

        return redirect()->back()->with('success', __('main.updated_model'));
    }
}
