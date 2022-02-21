<?php
namespace App\Exceptions\Registration;

class  AlreadyFinishRegistrationException extends \Exception {
    protected $message = 'this phone already finished registration';

}