<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  RecordHourBusyException extends CustomException {
    protected $message = 'record hour is busy at this doctor';
    protected $code = 409;
    public $HTTP_CODE = 400;

}
