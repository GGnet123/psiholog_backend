<?php

namespace App\Actions\Finance;

use App\Actions\AbstractAction;
use App\Models\Finance\CreditCard;

class SwitchActiveCreditCardAction extends AbstractAction
{

    protected function do()
    {
        CreditCard::where('user_id', $this->data['user_id'])->update(['is_active' => false]);
        $this->model->is_active = true;
        $this->model->is_removed = false;

        if ($this->model->save()) {
            return $this->model;
        }
        throw new \Exception("Card couldn't be switched");
    }
}
