<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  RecordIsNotOnWorkException extends CustomException {
    protected $message = 'this record status is note on work';
    protected $code = 01;

}
