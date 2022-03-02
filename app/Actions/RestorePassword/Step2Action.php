<?php
namespace  App\Actions\RestorePassword;

use App\Actions\AbstractAction;
use App\Exceptions\RestorePassword\NoteCreatedPinForRestorePasswordException;
use App\Exceptions\RestorePassword\NoteFoundedLoginException;
use App\Exceptions\RestorePassword\WrongPinForRestorePasswordException;
use App\Models\ResetPassword;
use App\Models\User;

class Step2Action extends  AbstractAction {
    function do (){
        $user = User::where('login', $this->data['login'])->first();
        if (!$user)
            throw new NoteFoundedLoginException();

        $reset = ResetPassword::where('user_id', $user->id)->where('done', false)->first();
        if (!$reset)
            throw new NoteCreatedPinForRestorePasswordException();

        if ($reset->pin != $this->data['pin'])
            throw new WrongPinForRestorePasswordException();

        return $user;
    }
}