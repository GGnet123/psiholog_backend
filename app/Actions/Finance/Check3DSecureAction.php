<?php
namespace App\Actions\Finance;

use Albakov\LaravelCloudPayments\Facade as CloudPay;
use App\Actions\AbstractAction;
use App\Exceptions\Finance\ErrorWithTransactionException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Check3DSecureAction extends AbstractAction {

    protected function do(){
        $card = $this->model;

        $this->check3dCodes();


        return $card;
    }

    protected function check3dCodes(){
        $data = [
            'TransactionId' => $this->data['MD'],
            'PaRes' => $this->data['PaRes']
        ];

        $result = CloudPay::cardsPost3ds($data);

        $this->model->last_response = $result;
        $this->model->save();

        $result = (object)$result;
        if ($result->Model)
            $res_model = (object)$result->Model;

        if (!$result->Success && $result->Message) {
            $this->model->is_accepted = false;
            $this->model->note = 'WrongCredentail';
            $this->model->save();

            return;
        }


        if (!$result->Success && property_exists($res_model, 'ReasonCode')) {
            $this->model->is_accepted = false;
            $this->model->note = __('finance.error.'.$res_model->ReasonCode);
            $this->model->save();

            return;
        }

        $this->model->is_accepted = true;
        $this->model->card_token = $res_model->Token;
        $this->model->is_active = true;
        $this->model->data_to_check_3d_secure = null;
        $this->model->save();

        $this->rollbackTransaction($res_model);
    }

    private function rollbackTransaction($res_model){
        $result = CloudPay::transactionsRefund(['TransactionId' => $res_model->TransactionId, 'Amount' => '100']);

    }

}
