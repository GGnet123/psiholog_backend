<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  ErrorWithTransactionException extends CustomException {
    protected $message = 'Error with transaction';
    protected $code = 00;
    public $HTTP_CODE = 401;

    function __construct(int $status_code = 0){
        if ($status_code != 0)
            $this->message = __('finance.error.'.$status_code);

        if ($status_code != 0)
            $this->code = $status_code;
    }

}
