<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finance\CardTransaction;
use App\Models\Main\Claim;
use App\Models\Main\Subscription;
use App\Models\Main\Support;
use App\Models\Record\RecordDoctor;
use App\Models\Services\UploaderFile;
use App\Models\User;
use App\Services\Cron\AutoRenewalSubscriptionService;
use App\Services\Cron\CalcWillPayedSubscriptionService;
use App\Services\Cron\CalcWillRecordService;
use App\Services\Cron\DeclineExpriredRecordService;
use App\Services\Cron\NeedDoAffirmationService;
use App\Services\Cron\NeedDoMeditationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndexController extends Controller {
    function saveFile(Request $request){
        $file = $request->file('upload_file');

        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_name = Str::slug($file_name);

        $file_path = $file->storeAs(
            'store/'.date('Y').'/'.date('m').'/'.date('d').'/'.rand(1000, 9999),
            $file_name.'.'.$file->getClientOriginalExtension());

        $size = $file->getSize();

        $title = $request->title && $request->title != '' ? $request->title : $file->getClientOriginalName();

        $model = UploaderFile::create([
            'path' => $file_path,
            'filesize' => $size,
            'filename' => $file_name,
            'extension' => $file->getClientOriginalExtension(),
            'title' => $title,
            'type_id' => $request->type_id
        ]);

        return $model;
    }

    function index(){
        return redirect()->route('admin_stat');
    }

    function stat(){
        //DeclineExpriredRecordService::do();
        //AutoRenewalSubscriptionService::do();

        //CalcWillRecordService::calc();
        //CalcWillPayedSubscriptionService::calc();

        //NeedDoMeditationService::do();
        //NeedDoAffirmationService::do();

        return view('stat.index', [
            'stat' => [
                'support' => $this->statSupport(),
                'claim' => $this->statClaim(),
                'subscription' => $this->statSubscription(),
                'record' => $this->statRecord(),
                'finance' => $this->statFinance(),
                'doctor' => $this->statDoctor(),
                'customers' => $this->statCustomer()
            ]
        ]);
    }

    private function statSupport(){
        return [
            'total' => Support::count(),
            'is_closed' => Support::where('is_closed', true)->count(),
            'is_note_closed'=> Support::where('is_closed', false)->count(),
        ];
    }

    private function statClaim(){
        return [
            'total' => Claim::count(),
            'is_closed' => Claim::where('is_done', true)->count(),
            'is_closed_note'=> Claim::where('is_done', false)->count(),
        ];

    }

    private function statSubscription(){
        return [
            'total' => Subscription::count(),
            'is_active' => Subscription::where('is_active', true)->count(),
            'is_active_note'=> Subscription::where('is_active', false)->count(),
            'is_cancel_by_user' => Subscription::where('is_cancel_by_user', true)->count(),
            'is_cancel_by_user_note'=> Subscription::where('is_cancel_by_user', false)->count(),
            'is_cancel_by_system' => Subscription::where('is_cancel_by_system', true)->count(),
            'is_cancel_by_system_note'=> Subscription::where('is_cancel_by_system', false)->count(),
        ];
    }

    private function statRecord(){
        $stat = [
            'total' => RecordDoctor::count(),
            'is_canceled' => RecordDoctor::where('is_canceled', true)->count(),
            'is_moved' => RecordDoctor::where('is_moved', true)->count(),
            'ar_status' => []
        ];

        foreach (RecordDoctor::getArStatus() as $status_id => $name){
            $stat['ar_status'][$status_id] = RecordDoctor::where('status_id', $status_id)->count();
        }

        return $stat;
    }

    private function statFinance(){
        return [
            'total_count' => CardTransaction::count(),
            'total_sum' => CardTransaction::sum('sum_transaction'),
            'is_done_count' => CardTransaction::where('is_done', true)->where('is_returned', false)->count(),
            'is_done_sum' => CardTransaction::where('is_done', true)->where('is_returned', false)->sum('sum_transaction'),
            'is_returned_count' => CardTransaction::where('is_done', true)->where('is_returned', true)->count(),
            'is_returned_sum' => CardTransaction::where('is_done', true)->where('is_returned', true)->sum('sum_transaction'),
        ];
    }

    private function statDoctor(){
        return [
            'total' => User::doctor()->count(),
            'is_blocked' => User::doctor()->where('is_blocked', true)->count(),
            'is_blocked_seance' => User::doctor()->where('is_blocked_seance', true)->count(),
        ];
    }

    private function statCustomer(){
        return [
            'total' => User::simpleUser()->count(),
            'is_blocked' => User::simpleUser()->where('is_blocked', true)->count(),
            'is_blocked_seance' => User::simpleUser()->where('is_blocked_seance', true)->count(),
        ];
    }

}
