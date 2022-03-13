<?php
namespace App\Exceptions;


class  HasNoteAccessException extends CustomException {
    protected $message = 'you has note access to this route';
    protected $code = 01;

}
