<?php
namespace App\Actions\Profile;

use App\Actions\AbstractAction;
use App\Models\Main\LibSpecialization;
use App\Models\Profile\UserSpecialization;
use Illuminate\Support\Facades\Hash;

class CheckPasswordAction extends AbstractAction {
    protected function do(){
        $user = $this->model;

        return Hash::check($this->data['password'], $user->password);
    }
}