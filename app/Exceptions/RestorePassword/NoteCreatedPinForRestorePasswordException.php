<?php
namespace App\Exceptions\RestorePassword;

use App\Exceptions\CustomException;

class  NoteCreatedPinForRestorePasswordException extends CustomException {
    protected $message = 'note created pin for restore password';
    protected $code = 01;


}