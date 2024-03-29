<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  AlreadyFinishRegistrationException extends CustomException {
    protected $message = 'this phone/email already finished registration';
    protected $code = 1002;
    public $HTTP_CODE = 400;

}
