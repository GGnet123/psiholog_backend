<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  AlreadyFinishRegistrationException extends CustomException {
    protected $message = 'this phone already finished registration';
    protected $code = 02;

}