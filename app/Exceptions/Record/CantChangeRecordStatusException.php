<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  CantChangeRecordStatusException extends CustomException {
    protected $message = 'can\'t change status to this record';
    protected $code = 01;

}
