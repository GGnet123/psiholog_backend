<?php
namespace App\Exceptions\Finance;

use App\Exceptions\CustomException;

class  ErrorWithTransactionException extends CustomException {
    protected $message = 'Error with transaction';
    protected $code = 303;
    public $HTTP_CODE = 400;

    function __construct(int $status_code = 0){
        if ($status_code != 0)
            $this->message = __('finance.error.'.$status_code);

        if ($status_code != 0)
            $this->code = $status_code;
    }

    function getPublicCode(){
        return $this->code;
    }

}
