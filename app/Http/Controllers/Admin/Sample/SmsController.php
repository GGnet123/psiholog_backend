<?php
namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsController extends Controller {
    function index(){
        return view(
            'sample.sms',
            [
                'app_id' => 'c067d0cde328417fb1342776098f6cd6',
            ]
        );
    }

    function save(Request $request){

    }

}