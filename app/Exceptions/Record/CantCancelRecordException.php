<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  CantCancelRecordException extends CustomException {
    protected $message = 'can\'t cancel this record';
    protected $code = 01;

}
