<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  UserNotHasActiveCreditCardException extends CustomException {
    protected $message = 'User not has active credit card';
    protected $code = 304;
    public $HTTP_CODE = 400;



}
