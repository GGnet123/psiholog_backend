<?php
namespace App\Exceptions\Registration;

class  AlreadyDoneRegistration extends \Exception {
    protected $message = 'this phone already finish registration';
    protected $code = 400;

}