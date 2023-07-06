<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  AlreadyDoneRegistration extends CustomException {
    protected $message = 'this phone/email already finish registration';
    protected $code = 1001;
    public $HTTP_CODE = 400;

}
