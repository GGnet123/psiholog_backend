<?php
namespace App\Services;

use Albakov\LaravelCloudPayments\Facade as CloudPay;
use App\Exceptions\Finance\ErrorWithTransactionException;
use App\Models\Finance\CardTransaction;
use App\Models\Finance\CreditCard;
use Exception;

class MakeTransactionService {
    private CreditCard $card;
    private CardTransaction $transaction;
    private array $data;

    static function do(CreditCard $card, CardTransaction $transaction, array $data){
        $el = new MakeTransactionService();
        return $el->pay($card, $transaction, $data);
    }

    function pay(CreditCard $card, CardTransaction $transaction, array $data){
        $this->card = $card;
        $this->transaction = $transaction;
        $this->data = $data;

        $this->createRequest();

        return $this->transaction;
    }

    private function createRequest(){
        $result = CloudPay::tokensCharge($this->data);

        $result = (object) $result;
        if ($result->Model)
            $res_model = (object)$result->Model;

        if (!$result->Success && $result->Message)
            $this->error(new WrongCredentialDataException(), (array)$result);

        if (!$result->Success && property_exists($res_model, 'ReasonCode'))
            $this->error(new ErrorWithTransactionException($res_model->ReasonCode), (array)$result, $res_model->TransactionId);

        if (!$result->Success)
            $this->error(new ErrorWithTransactionException(), (array)$result);

        $this->transaction->transaction_id = $res_model->TransactionId;
        $this->transaction->last_request = $this->data;
        $this->transaction->last_response = (array)$result;
        $this->transaction->is_done = true;
        $this->transaction->save();
    }

    private function error(Exception $exception, array $result, string $TransactionId = ''){
        if ($exception instanceof  WrongCredentialDataException)
            $this->card->note = 'WrongCredentailData';
        if ($exception instanceof  ErrorWithTransactionException)
            $this->card->note = __('finance.error.'.$exception->getPublicCode());

        $this->card->save();

        $this->transaction->transaction_id = $TransactionId;
        $this->transaction->last_request = $this->data;
        $this->transaction->last_response = (array)$result;
        $this->transaction->is_done = false;
        $this->transaction->save();

        throw $exception;
    }


}
