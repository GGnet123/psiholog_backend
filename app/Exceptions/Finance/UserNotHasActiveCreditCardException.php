<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  UserNotHasActiveCreditCardException extends CustomException {
    protected $message = 'User not has active credit card';
    protected $code = 00;
    public $HTTP_CODE = 401;



}
