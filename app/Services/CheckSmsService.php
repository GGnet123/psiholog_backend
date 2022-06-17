<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CheckSmsService {
    private string $url_get_session = 'https://identitytoolkit.googleapis.com/v1/accounts:sendVerificationCode';
    private string $url_check_pin = 'https://identitytoolkit.googleapis.com/v1/accounts:signInWithPhoneNumber';
    public string $message = '';

    static function check($phone, $pin){
        $el = new CheckSmsService();
        $res = $el->run($phone, $pin);
        if (!$res)
            return $el->message;

        return true;
    }

    function run($phone, $pin) : bool{
        $key = config('firebase.api_key');

        $response = Http::post($this->url_get_session.'?key='.$key, [
            'phoneNumber' => '+'.$phone
        ]);

        if (!$response->successful()) {
            $this->message = 'wrong_number';
            return false;
        }

        $token = $response->json();
        $token = $token['sessionInfo'];

        $response = Http::post($this->url_check_pin.'?key='.$key, [
            'sessionInfo' => $token,
            'code' => $pin
        ]);

        if (!$response->successful()){
            $this->message = 'wrong_pin';
            return false;
        }

        return true;
    }
}
