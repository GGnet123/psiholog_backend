<?php
namespace App\Actions\CreatePassword;

use App\Actions\AbstractAction;
use App\Exceptions\CreatePassword\LoginAlreadyExistException;
use App\Models\User;

class CheckLoginAction extends AbstractAction {
    protected function do(){
        if (User::where('login', $this->data['login'])->count())
            throw new LoginAlreadyExistException();


        return true;
    }
}
