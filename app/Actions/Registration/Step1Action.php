<?php
namespace App\Actions\Registration;

use App\Actions\AbstractAction;
use App\Exceptions\Registration\AlreadyFinishRegistrationException;
use App\Exceptions\Registration\AlreadyDoneRegistration;
use App\Exceptions\Registration\NoteFinishedRegistrationException;
use App\Models\PhoneRegistration;
use App\Models\User;

class Step1Action extends AbstractAction {
    protected function do(){
        if (User::where('login', $this->data['login'])->count())
            throw new AlreadyDoneRegistration();

        $this->model = PhoneRegistration::where(['phone' => $this->data['login']])->first();
        if ($this->model && $this->model->accepted == false)
            throw new NoteFinishedRegistrationException();

        if ($this->model && $this->model->accepted)
            throw new AlreadyFinishRegistrationException();


        $this->model = new PhoneRegistration();
        $this->model->phone = $this->data['login'];
        $this->model->generatePin();
        $this->model->accepted = false;
        $this->model->save();

        // TODO need add send sms pin to phone

        return $this->model;
    }
}