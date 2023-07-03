<?php
namespace App\Http\Controllers\Admin\Main;

use App\Actions\MainUpdateAction;
use App\Actions\Profile\LibSpecializationAction;
use App\Events\UserIsBlockedEvent;
use App\Http\Controllers\Controller;
use App\Models\Profile\UserCertificat;
use App\Models\Services\UploaderFile;
use App\Models\Timetable\TimetablePlan;
use App\Models\User;
use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function edit(Request $request, Model $item){
        $title = __($this->title_path.'_edit');

        $timetable = $item->relTimetablePlan;
        if (!$timetable) {
            $timetable = $item->createDefaultTimeTable();
        }

        $data =  [
            'title' => $title,
            'model' => $item,
            'ar_bread' => [
                route($this->route_path) => __($this->title_path.'')
            ],
            'request' => $request,
            'route_path' => $this->route_path,
            'specializations' => $item->relSpecilizationMain()->pluck('name', 'lib_specialization.id')->toArray(),
            'certificats' => $item->relCertificatsMain,
            'videos' => $item->relVideoMain,
            'timetable' => $timetable
        ];


        return view($this->view_path.'.edit', $data);
    }

    public function update(Request $request, Model $item){
        $action = new MainUpdateAction($item, $request->all());

        $spec = new LibSpecializationAction($item, [
            'specialization_array' => $request->get('specializations'),
            'user_id' => $item->id
        ]);
        try {
            $action->run();
            $spec->run();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route($this->route_path.'_show', $item)->with('success', __('main.updated_model'));
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

    function setTimeTableTime(Request $request) {
        $data = $request->all();
        $table = TimetablePlan::where('user_id', $data['doctor_id'])->first();
        $table->update([$data['col'] => !$table[$data['col']]]);

        return ['value' => !$table[$data['col']]];
    }

    function uploadDocument(Request $request) {
        $file = $request->file('file');
        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_name = Str::slug($file_name);

        $file_path = $file->storeAs(
            'store/'.time().'/'.rand(1000, 9999),
            $file_name.'.'.$file->getClientOriginalExtension());

        $size = $file->getSize();

        $title = $file->getClientOriginalName();

        $model = UploaderFile::create([
            'path' => $file_path,
            'filesize' => $size,
            'filename' => $file_name,
            'extension' => $file->getClientOriginalExtension(),
            'title' => $title,
            'type_id' => UploaderFile::DOCUMENT
        ]);

        $user = User::where('id', $request->post('user_id'))->first();
        $user->document_id = $model->id;
        $user->save();

        return ['file_id' => $model->id];
    }

    function uploadCertificates(Request $request) {
        $files = $request->file('file');
        $response = [];
        foreach ($files as $file) {
            $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = Str::slug($file_name);

            $file_path = $file->storeAs(
                'store/'.time().'/'.rand(1000, 9999),
                $file_name.'.'.$file->getClientOriginalExtension());

            $size = $file->getSize();

            $title = $file->getClientOriginalName();

            $model = UploaderFile::create([
                'path' => $file_path,
                'filesize' => $size,
                'filename' => $file_name,
                'extension' => $file->getClientOriginalExtension(),
                'title' => $title,
                'type_id' => UploaderFile::IMAGE
            ]);

            $cert = new UserCertificat();
            $cert->user_id = $request->post('user_id');
            $cert->sertificat_id = $model->id;
            $cert->save();

            $response[] = ['file_id' => $model->id, 'path' => $model->path, 'title' => $title, 'extension' => $model->extension];
        }
        return $response;
    }

    function deleteCert(Request $request) {
        $certId=$request->post('cert_id');
        UserCertificat::where('sertificat_id', $certId)->delete();
        UploaderFile::where('id', $certId)->delete();
        return true;
    }
}
