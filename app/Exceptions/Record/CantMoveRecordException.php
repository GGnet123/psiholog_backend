<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  CantMoveRecordException extends CustomException {
    protected $message = 'can\'t move this record';
    protected $code = 01;

}
