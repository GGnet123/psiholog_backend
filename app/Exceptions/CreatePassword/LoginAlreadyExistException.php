<?php
namespace App\Exceptions\CreatePassword;

use App\Exceptions\CustomException;

class  LoginAlreadyExistException extends CustomException {
    protected $message = 'This login already exist';
    protected $code = 001;
    public $HTTP_CODE = 400;

}
