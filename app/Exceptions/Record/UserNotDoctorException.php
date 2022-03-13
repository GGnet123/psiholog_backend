<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  UserNotDoctorException extends CustomException {
    protected $message = 'this user note a doctor';
    protected $code = 01;

}
