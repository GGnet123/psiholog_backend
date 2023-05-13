<?php
namespace App\Exceptions\Main;

use App\Exceptions\CustomException;

class  ForbiddenException extends CustomException {
    protected $message = 'Forbidden. You don\'t have permission to access this route';
    protected $code = 123;
    public $HTTP_CODE = 401;

}
