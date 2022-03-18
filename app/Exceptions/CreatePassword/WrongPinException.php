<?php
namespace App\Exceptions\CreatePassword;

use App\Exceptions\CustomException;

class  WrongPinException extends CustomException {
    protected $message = 'wrong pin for done registration';
    protected $code = 05;

}
