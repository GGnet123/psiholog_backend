<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Cron\DeclineExpriredRecordService;

class IndexController extends Controller {
    function index(){

        DeclineExpriredRecordService::do();

        return view('index');
    }

}
