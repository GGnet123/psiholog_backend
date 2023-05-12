<?php
namespace App\Actions\Registration;

use App\Actions\AbstractAction;
use App\Exceptions\Registration\AlreadyFinishRegistrationException;
use App\Exceptions\Registration\AlreadyDoneRegistration;
use App\Exceptions\Registration\NoteFoundedPhoneRegistrationException;
use App\Exceptions\Registration\PhoneNoteFoundedInFirebaseException;
use App\Exceptions\Registration\WrongPinException;
use App\Models\EmailRegistration;
use App\Models\User;
use App\Services\CheckSmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Step2EmailAction extends AbstractAction {
    protected function do(){
        if (User::where('email', $this->data['email'])->count())
            throw new AlreadyDoneRegistration();

        $this->model = EmailRegistration::where(['email' => $this->data['email']])->first();
        if ($this->model && $this->model->accepted)
            throw new AlreadyFinishRegistrationException();

        if (!$this->model)
            throw new NoteFoundedPhoneRegistrationException();


        if ($this->model->pin != $this->data['pin']) {
            throw new WrongPinException();
        }

        $this->model->accepted = true;
        $this->model->save();

        $user = new User();
        $user->type_id = User::NOTE_FINISHED_TYPE;
        $user->email = $this->data['email'];
        $user->password = Hash::make($this->data['password']);
        $user->name = '';
        $user->lang = User::EN_LANG;
        $user->save();

        Auth::login($user);

        return $user;
    }
}
