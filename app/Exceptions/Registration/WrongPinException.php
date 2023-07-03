<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  WrongPinException extends CustomException {
    protected $message = 'wrong pin for done registration';
    protected $code = 1007;
    public $HTTP_CODE = 400;

}
