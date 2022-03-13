<?php
namespace App\Exceptions\Record;

use App\Exceptions\CustomException;

class  NoteHasTimetableException extends CustomException {
    protected $message = 'this doctor note has timetable';
    protected $code = 01;

}
