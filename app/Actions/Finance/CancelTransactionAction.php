<?php
namespace App\Actions\Finance;

use Albakov\LaravelCloudPayments\Facade as CloudPay;
use App\Actions\AbstractAction;
use App\Exceptions\Finance\ErrorWithTransactionException;
use App\Models\User;
use App\Services\CancelTransactionService;
use Illuminate\Support\Facades\Auth;

class CancelTransactionAction extends AbstractAction {

    protected function do(){
        CancelTransactionService::do($this->model);

        $this->model->is_returned = true;
        $this->model->save();


        return $this->model;
    }

}
