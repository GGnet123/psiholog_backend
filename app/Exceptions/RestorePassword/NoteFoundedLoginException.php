<?php
namespace App\Exceptions\RestorePassword;

use App\Exceptions\CustomException;

class  NoteFoundedLoginException extends CustomException {
    protected $message = 'note founded login for restore password';
    protected $code = 1111;
    public $HTTP_CODE = 400;

}
