<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  CantFindActiveTransactionToReturnMoneyException extends CustomException {
    protected $message = 'Cant find active transaction for return money to customer';
    protected $code = 302;
    public $HTTP_CODE = 400;



}
