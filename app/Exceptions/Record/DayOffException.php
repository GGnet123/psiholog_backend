<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  DayOffException extends CustomException {
    protected $message = 'this day doctor note working';
    protected $code = 01;

}
