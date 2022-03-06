<?php
namespace App\Exceptions\RestorePassword;

use App\Exceptions\CustomException;

class  PhoneNoteFoundedInFirebaseForRestoreException extends CustomException {
    protected $message = 'this phone note founded in firebase';
    protected $code = 04;

}