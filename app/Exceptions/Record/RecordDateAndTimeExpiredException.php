<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  RecordDateAndTimeExpiredException extends CustomException {
    protected $message = 'record time is expired';
    protected $code = 408;
    public $HTTP_CODE = 400;

}
