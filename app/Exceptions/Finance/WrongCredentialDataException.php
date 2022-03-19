<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  WrongCredentialDataException extends CustomException {
    protected $message = 'Wrong credit card data';
    protected $code = 00;
    public $HTTP_CODE = 401;

}
