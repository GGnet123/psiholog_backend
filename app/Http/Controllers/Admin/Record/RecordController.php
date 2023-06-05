<?php
namespace App\Http\Controllers\Admin\Record;

use App\Http\Controllers\Controller;
use App\Models\Record\RecordDoctor;
use App\Models\Record\RecordDoctor as Model;
use App\Notifications\Fcm\CancelRecordByDoctorNotification;
use Illuminate\Http\Request;

class  RecordController extends Controller{
    protected $view_path = 'page.record.record';
    protected $route_path = 'admin_record';
    protected $title_path = 'title.admin_record';
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

        return view($this->view_path.'.show', [
            'title' => $title,
            'model' => $item,
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.'')
            ],
            'request' => $request,
            'route_path' => $this->route_path,
            'logs' => $item->relLogs
        ]);
    }

    public function cancel(Request $request, Model $item) {
        $record = RecordDoctor::where('id', $item['id'])->first();
        $record->status_id = RecordDoctor::DECLINE_BY_DOCTOR;
        $record->save();
        if (env('APP_ENVIRONMENT') == 'prod') {
            $item->relCustomer->notify(new CancelRecordByDoctorNotification($item));
        }
        return redirect()->back();
    }

}
