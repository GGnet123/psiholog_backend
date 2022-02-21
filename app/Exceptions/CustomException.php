<?php
namespace  App\Exceptions;

abstract class CustomException extends \Exception {
    public $HTTP_CODE = 400;
    public $code = 0;
}