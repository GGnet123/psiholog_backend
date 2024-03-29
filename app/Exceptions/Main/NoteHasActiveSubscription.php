<?php
namespace App\Exceptions\Main;

use App\Exceptions\CustomException;

class  NoteHasActiveSubscription extends CustomException {
    protected $message = 'This user note has active subscription';
    protected $code = 125;
    public $HTTP_CODE = 400;

}
