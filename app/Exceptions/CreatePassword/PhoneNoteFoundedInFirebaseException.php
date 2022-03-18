<?php
namespace App\Exceptions\CreatePassword;

use App\Exceptions\CustomException;

class  PhoneNoteFoundedInFirebaseException extends CustomException {
    protected $message = 'this phone note founded in firebase';
    protected $code = 04;

}
