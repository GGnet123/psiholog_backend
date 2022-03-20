<?php
namespace App\Exceptions\RestorePassword;

use App\Exceptions\CustomException;

class  WrongPinForRestorePasswordException extends CustomException {
    protected $message = 'wrong pin for restore password';
    protected $code = 1113;
    public $HTTP_CODE = 400;


}
