<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckSmsService {
    private string $url_get_session = 'https://identitytoolkit.googleapis.com/v1/accounts:sendVerificationCode';
    private string $url_check_pin = 'https://identitytoolkit.googleapis.com/v1/accounts:signInWithPhoneNumber';
    public string $message = '';

    static function check($pin, $sessionInfo){
        $el = new CheckSmsService();
        $res = $el->run($pin, $sessionInfo);
        if (!$res)
            return $el->message;

        return true;
    }

    function run($pin, $sessionInfo) : bool{
        $key = config('firebase.api_key');
        $response = Http::post($this->url_check_pin.'?key='.$key, [
            'sessionInfo' => $sessionInfo,
            'code' => $pin
        ]);

        if (!$response->successful()){
            Log::info(json_encode(['sessionInfo' => $sessionInfo]));
            Log::info(json_encode($response->json()));
            $this->message = 'wrong_pin';
            return false;
        }

        return true;
    }
}
