<?php
namespace App\Exceptions\Registration;

use App\Exceptions\CustomException;

class  PhoneNoteFoundedInFirebaseException extends CustomException {
    protected $message = 'this phone note founded in firebase';
    protected $code = 1006;
    public $HTTP_CODE = 400;

}
