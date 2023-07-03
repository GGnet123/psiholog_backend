<?php
namespace App\Exceptions;


class CanNotStartSessionYet extends CustomException {
    protected $message = 'Can not start session earlier than 5 minutes before.';
    protected $code = 03;
    public $HTTP_CODE = 400;

}
