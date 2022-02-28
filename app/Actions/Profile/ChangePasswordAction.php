<?php
namespace App\Actions\Profile;

use App\Actions\AbstractAction;
use App\Models\Main\LibSpecialization;
use App\Models\Profile\UserSpecialization;
use Illuminate\Support\Facades\Hash;

class ChangePasswordAction extends AbstractAction {
    protected function do(){
        $user = $this->model;
        $user->password = Hash::make($this->data['password']);
        $user->save();

        return $user;
    }
}