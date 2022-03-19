<?php
namespace App\Actions\Finance;

use Albakov\LaravelCloudPayments\Facade as CloudPay;
use App\Actions\AbstractAction;
use App\Exceptions\Finance\AlreadyHasActiveCreditCardException;
use App\Exceptions\Finance\ErrorWithTransactionException;
use App\Exceptions\Finance\WrongCredentialDataException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateCreditCardAction extends AbstractAction {
    private User $user;

    protected function do(){
        $card = $this->model;
        $this->user = Auth::user();
        if ($this->user->hasActiveCreditCard())
            throw new AlreadyHasActiveCreditCardException();

        $this->createCard();
        $this->testCharge();

        return $card;
    }

    private function createCard(){
        $this->model->user_id = $this->data['user_id'];
        $this->model->card_crypto = $this->data['card_crypto'];
        $this->model->first_symbol = $this->data['first_symbol'];
        $this->model->last_symbol = $this->data['last_symbol'];
        $this->model->email = $this->data['email'];
        $this->model->ip = $this->data['ip_address'];
        $this->model->save();
    }

    function testCharge(){
        $array = [
            'Amount' => 100, // Required
            'Currency' => 'KZT', // Required
            'Name' => $this->user->name, // Required
            'IpAddress' => $this->model->ip, // Required
            'CardCryptogramPacket' => $this->model->card_crypto, // Required
            'InvoiceId' => time(),
            'Description' => 'Payment for order №' . time(),
            'AccountId' => $this->user->id,
            'Email' => $this->model->email
        ];


        $result = CloudPay::cardsCharge($array);

        $this->model->last_response = $result;
        $this->model->save();

        $result = (object) $result;
        if ($result->Model)
            $res_model = (object)$result->Model;

        if (!$result->Success && $result->Message)
            throw new WrongCredentialDataException();


        if (!$result->Success && property_exists($res_model, 'ReasonCode'))
            throw new ErrorWithTransactionException($res_model->ReasonCode);

        if (!$result->Success && $res_model->AcsUrl)
            return $this->create3DSecure($res_model);

        if (!$result->Success)
            throw new ErrorWithTransactionException();


        $this->model->is_accepted = true;
        $this->model->card_token = $res_model->Token;
        $this->model->is_active = true;
        $this->model->data_to_check_3d_secure = null;
        $this->model->save();

        $this->rollbackTransaction($res_model);
    }

    private function rollbackTransaction($res_model){
        CloudPay::transactionsRefund(['TransactionId' => $res_model->TransactionId, 'Amount' => '100']);
    }

    private function create3DSecure($res_model){
        $check_data = [
            'action_url' => $res_model->AcsUrl,
            'PaReq' => $res_model->PaReq,
            'MD' => $res_model->TransactionId,
            'TermUrl' => route('check_3d_pay', ['item' => $this->model->id, 'hash' => config('cloudpayments.secret_for_check_3d_secure')])
        ];

        $this->model->data_to_check_3d_secure = $check_data;
        $this->model->is_3d_secure = true;
        $this->model->save();
    }
}
