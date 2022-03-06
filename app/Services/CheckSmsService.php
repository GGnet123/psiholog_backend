<?php
namespace App\Services;

use App\Exceptions\Registration\PhoneNoteFoundedInFirebaseException;
use App\Exceptions\Registration\WrongPinException;
use Illuminate\Support\Facades\Http;

class CheckSmsService {
    private string $url_get_session = 'https://identitytoolkit.googleapis.com/v1/accounts:sendVerificationCode';
    private string $url_check_pin = 'https://identitytoolkit.googleapis.com/v1/accounts:signInWithPhoneNumber';

    static function check($phone, $pin){
        $el = new CheckSmsService();
        $res = $el->run($phone, $pin);
    }

    function run($phone, $pin) : bool{
        $key = config('firebase.api_key');

        $response = Http::post($this->url_get_session.'?key='.$key, [
            'phoneNumber' => '+'.$phone
        ]);

        if (!$response->successful())
            throw new PhoneNoteFoundedInFirebaseException();

        $token = $response->json();
        $token = $token['sessionInfo'];

        $response = Http::post($this->url_check_pin.'?key='.$key, [
            'sessionInfo' => $token,
            'code' => $pin
        ]);

        if (!$response->successful())
            throw new WrongPinException();

        return true;
    }
}