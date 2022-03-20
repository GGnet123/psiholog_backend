<?php
namespace App\Exceptions\CreatePassword;

use App\Exceptions\CustomException;

class  PhoneNoteFoundedInFirebaseException extends CustomException {
    protected $message = 'this phone note founded in firebase';
    protected $code = 002;
    public $HTTP_CODE = 400;

}
