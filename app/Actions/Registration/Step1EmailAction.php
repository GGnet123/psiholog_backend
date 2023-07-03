<?php
namespace App\Actions\Registration;

use App\Actions\AbstractAction;
use App\Exceptions\Registration\AlreadyFinishRegistrationException;
use App\Exceptions\Registration\AlreadyDoneRegistration;
use App\Exceptions\Registration\NoteFinishedRegistrationException;
use App\Models\EmailRegistration;
use App\Models\User;
use App\Services\SendEmailService;

class Step1EmailAction extends AbstractAction {
    protected function do(){
        if (User::where('email', $this->data['email'])->count())
            throw new AlreadyDoneRegistration();

        $this->model = EmailRegistration::where(['email' => $this->data['email']])->first();

        if ($this->model && $this->model->accepted)
            throw new AlreadyFinishRegistrationException();

        $pin = rand(1000, 9999);
        if (!$this->model) {
            $this->model = new EmailRegistration();
        }
        $this->model->email = $this->data['email'];
        $this->model->accepted = false;
        $this->model->pin = $pin;
        if ($this->model->save()) {
            $mailer = new SendEmailService($this->data['email'], "Registration code", $this->model->pin);
            if ($mailer->send()) {
                return $this->model;
            }
            throw new \Exception("Internal error, couldn't send email", 500);
        }
        throw new \Exception("Internal error, couldn't save data", 500);
    }
}
