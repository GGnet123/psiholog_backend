<?php
namespace App\Http\Controllers\Admin\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $key = config('firebase.api_key');

        $response = Http::post('https://identitytoolkit.googleapis.com/v1/accounts:sendVerificationCode?key='.$key, [
            'phoneNumber' => '+77024982488',
            'key' => $key
        ]);

        if (!$response->successful())
            return redirect()->back();

        $token = $response->json();
        $token = $token['sessionInfo'];

        $response = Http::post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPhoneNumber?key='.$key, [
            'sessionInfo' =>$token,
            'code' => '123456'
        ]);

        if (!$response->successful())
            return redirect()->back();

        dd($key, $response->json());
    }

}