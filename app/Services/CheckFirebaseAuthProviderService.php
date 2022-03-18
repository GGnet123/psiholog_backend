<?php
namespace App\Services;

use App\Exceptions\Registration\PhoneNoteFoundedInFirebaseException;
use App\Exceptions\Registration\WrongPinException;
use Illuminate\Support\Facades\Http;

class CheckFirebaseAuthProviderService {
    private string $url_check = 'https://identitytoolkit.googleapis.com/v1/accounts:signInWithIdp';
    public string $message = '';

    static function check(string $id_token, string $provider){
        $el = new CheckFirebaseAuthProviderService();
        return $el->run($id_token, $provider);
    }

    function run($id_token, $provider) : ?string{
        $key = config('firebase.api_key');

        $response = Http::post($this->url_check.'?key='.$key, [
            'postBody' => 'access_token='.$id_token.'&providerId='.$provider,
            'requestUri' => 'http://localhost:8000',
            'returnIdpCredential' => true,
            'returnSecureToken' => true
        ]);

        if (!$response->successful()) {
            $this->message = 'wrong token or provider';
            return null;
        }


        $id = $response->json();

        return $id['federatedId'];
    }
}
