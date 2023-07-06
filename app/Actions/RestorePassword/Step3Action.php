<?php
namespace  App\Actions\RestorePassword;

use App\Actions\AbstractAction;
use App\Exceptions\RestorePassword\NoteCreatedPinForRestorePasswordException;
use App\Exceptions\RestorePassword\NoteFoundedLoginException;
use App\Exceptions\RestorePassword\PhoneNoteFoundedInFirebaseForRestoreException;
use App\Exceptions\RestorePassword\WrongPinForRestorePasswordException;
use App\Models\ResetPassword;
use App\Models\User;
use App\Services\CheckSmsService;
use Illuminate\Support\Facades\Hash;

class Step3Action extends  AbstractAction {
    function do (){
        $user = User::where('login', $this->data['login'])->first();
        if (!$user)
            throw new NoteFoundedLoginException();

        $reset = ResetPassword::where('user_id', $user->id)->where('done', false)->first();
        if (!$reset)
            throw new NoteCreatedPinForRestorePasswordException();

        $res_check_pin = CheckSmsService::check($this->data['pin'], $this->data['sessionInfo']);
        if ($res_check_pin !== true && $res_check_pin == 'wrong_number')
            throw new PhoneNoteFoundedInFirebaseForRestoreException();
        else if ($res_check_pin !== true && $res_check_pin == 'wrong_pin')
            throw new WrongPinForRestorePasswordException();

        $user->password = Hash::make($this->data['password']);
        $user->save();

        $reset->done = true;
        $reset->save();

        return $user;
    }
}
