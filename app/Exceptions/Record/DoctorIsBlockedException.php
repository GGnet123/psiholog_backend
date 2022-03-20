<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  DoctorIsBlockedException extends CustomException {
    protected $message = 'this doctor is blocked access to seance by admin';
    protected $code = 406;
    public $HTTP_CODE = 400;

}
