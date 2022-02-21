<?php
namespace App\Actions\Registration;

use App\Actions\AbstractAction;
use App\Models\User;

class Step3UserAction extends AbstractAction {
    protected function do(){
        $this->model->fill($this->data);
        $this->model->type_id = User::USER_TYPE;
        $this->model->save();

        return $this->model;
    }
}