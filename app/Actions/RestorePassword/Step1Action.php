<?php
namespace  App\Actions\RestorePassword;

use App\Actions\AbstractAction;
use App\Exceptions\RestorePassword\NoteFoundedLoginException;
use App\Models\ResetPassword;
use App\Models\User;

class Step1Action extends  AbstractAction {
    function do (){
        $user = User::where('login', $this->data['login'])->first();
        if (!$user)
            throw new NoteFoundedLoginException();

        $reset = ResetPassword::where('user_id', $user->id)->where('done', false)->first();
        if (!$reset)
            $reset = ResetPassword::create(['user_id'=>$user->id, 'done' => false, 'pin' => 123456]);

        // TODO need add send sms pin to phone


        return $user;
    }
}