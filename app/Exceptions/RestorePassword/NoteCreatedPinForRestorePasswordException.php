<?php
namespace App\Exceptions\RestorePassword;

use App\Exceptions\CustomException;

class  NoteCreatedPinForRestorePasswordException extends CustomException {
    protected $message = 'note created pin for restore password';
    protected $code = 1110;
    public $HTTP_CODE = 400;


}
