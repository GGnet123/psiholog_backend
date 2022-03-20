<?php
namespace App\Exceptions;


class  HasNoteAccessException extends CustomException {
    protected $message = 'you has note access to this route';
    protected $code = 02;
    public $HTTP_CODE = 401;

}
