<?php
namespace App\Exceptions\Registration;

class  WrongPinException extends \Exception {
    protected $message = 'wrong pin for done registration';

}