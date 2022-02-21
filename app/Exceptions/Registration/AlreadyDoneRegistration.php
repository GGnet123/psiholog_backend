<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  AlreadyDoneRegistration extends CustomException {
    protected $message = 'this phone already finish registration';
    protected $code = 01;

}