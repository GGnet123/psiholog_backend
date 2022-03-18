<?php
namespace App\Actions\CreatePassword;

use App\Actions\AbstractAction;
use App\Exceptions\CreatePassword\LoginAlreadyExistException;
use App\Exceptions\CreatePassword\PhoneNoteFoundedInFirebaseException;
use App\Exceptions\CreatePassword\WrongPinException;
use App\Models\User;
use App\Services\CheckSmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SaveAction extends AbstractAction {
    protected function do(){
        if (User::where('login', $this->data['login'])->count())
            throw new LoginAlreadyExistException();

        $res_check_pin = CheckSmsService::check($this->data['login'], $this->data['pin']);
        if ($res_check_pin !== true && $res_check_pin == 'wrong_number')
            throw new PhoneNoteFoundedInFirebaseException();
        else if ($res_check_pin !== true && $res_check_pin == 'wrong_pin')
            throw new WrongPinException();

        $this->model->login = $this->data['login'];
        $this->model->password = Hash::make($this->data['password']);
        $this->model->save();

        return $this->model;
    }
}
