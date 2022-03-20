<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Cron\AutoRenewalSubscriptionService;
use App\Services\Cron\DeclineExpriredRecordService;

class IndexController extends Controller {
    function index(){

        DeclineExpriredRecordService::do();
        AutoRenewalSubscriptionService::do();

        return view('index');
    }

}
