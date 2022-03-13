<?php
namespace App\Exceptions\Main;

use App\Exceptions\CustomException;

class  HasActiveSubscriptionException extends CustomException {
    protected $message = 'This user has subscription';
    protected $code = 00;
    public $HTTP_CODE = 401;

}