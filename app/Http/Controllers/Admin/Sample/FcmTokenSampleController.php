<?php
namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;

class FcmTokenSampleController extends Controller {
    function index(){
        return view('sample.fcm_token');

    }

}
