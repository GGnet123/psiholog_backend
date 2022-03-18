<?php
namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;

class FirebaseAuthController extends Controller {
    function index(){
        return view(
            'sample.firebase_auth'
        );
    }
}
