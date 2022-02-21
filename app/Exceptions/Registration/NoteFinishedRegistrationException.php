<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  NoteFinishedRegistrationException extends CustomException {
    protected $message = 'this phone note finished registration';
    public $code = 01;

}