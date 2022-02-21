<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  NoteFoundedPhoneRegistrationException extends CustomException {
    protected $message = 'note founded phone for registration';
    protected $code = 04;

}