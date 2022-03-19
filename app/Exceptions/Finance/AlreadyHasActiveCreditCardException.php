<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  AlreadyHasActiveCreditCardException extends CustomException {
    protected $message = 'Already has active credit card';
    protected $code = 00;
    public $HTTP_CODE = 401;



}