<?php
namespace App\Actions\Registration;

use App\Actions\AbstractAction;
use App\Exceptions\Registration\AlreadyFinishRegistrationException;
use App\Exceptions\Registration\AlreadyDoneRegistration;
use App\Exceptions\Registration\NoteFoundedPhoneRegistrationException;
use App\Exceptions\Registration\PhoneNoteFoundedInFirebaseException;
use App\Exceptions\Registration\WrongPinException;
use App\Models\PhoneRegistration;
use App\Models\User;
use App\Services\CheckSmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class Step2Action extends AbstractAction {
    protected function do(){
        if (User::where('login', $this->data['login'])->count())
            throw new AlreadyDoneRegistration();

        $this->model = PhoneRegistration::where(['phone' => $this->data['login']])->first();
        if ($this->model && $this->model->accepted)
            throw new AlreadyFinishRegistrationException();

        if (!$this->model)
            throw new NoteFoundedPhoneRegistrationException();

        Log::info(json_encode(['sessionInfo' => $this->data['sessionInfo']]));
        $res_check_pin = CheckSmsService::check($this->data['pin'], $this->data['sessionInfo']);
        if ($res_check_pin !== true && $res_check_pin == 'wrong_number')
            throw new PhoneNoteFoundedInFirebaseException();
        else if ($res_check_pin !== true && $res_check_pin == 'wrong_pin')
            throw new WrongPinException();



        $this->model->accepted = true;
        $this->model->save();

        $user = new User();
        $user->type_id = User::NOTE_FINISHED_TYPE;
        $user->login = $this->data['login'];
        $user->password = /*Hash::make($this->data['password'])*/'blank';
        $user->name = '';
        $user->lang = User::EN_LANG;
        $user->save();

        Auth::login($user);

        return $user;
    }
}
