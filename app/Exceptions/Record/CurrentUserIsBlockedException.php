<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  CurrentUserIsBlockedException extends CustomException {
    protected $message = 'current user is blocked access to seance by admin';
    protected $code = 01;

}
