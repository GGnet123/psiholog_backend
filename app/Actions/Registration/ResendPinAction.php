<?php
namespace App\Actions\Registration;

use App\Actions\AbstractAction;
use App\Exceptions\Registration\AlreadyDoneRegistration;
use App\Exceptions\Registration\AlreadyFinishRegistrationException;
use App\Exceptions\Registration\NoteFinishedRegistrationException;
use App\Exceptions\Registration\NoteFoundedPhoneRegistrationException;
use App\Models\PhoneRegistration;
use App\Models\User;

class ResendPinAction extends AbstractAction {
    protected function do(){
        $this->model = PhoneRegistration::where(['phone' => $this->data['login']])->first();
        if (!$this->model)
            throw new NoteFoundedPhoneRegistrationException();

        if ($this->model->accepted)
            throw new AlreadyFinishRegistrationException();

        return $this->model;
    }
}