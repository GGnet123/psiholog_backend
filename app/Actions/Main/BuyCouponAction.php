<?php

namespace App\Actions\Main;

use App\Actions\AbstractAction;
use App\Exceptions\Finance\UserNotHasActiveCreditCardException;
use App\Models\Finance\CardTransaction;
use App\Models\Main\Coupon;
use App\Models\User;
use App\Services\CreateSubscriptionTransactionService;
use App\Services\MakeTransactionService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class BuyCouponAction extends AbstractAction
{
    const TriesCount = 10;
    public CardTransaction $transaction;
    public Authenticatable $user;
    public $card;
    protected function do()
    {
        if (!$this->data['sum']) {
            throw new \Exception("Sum should be greater than 0");
        }
        $model = $this->model;
        $model->sum = $this->data['sum'];
        $model->is_used = false;

        $this->user = Auth::user();
        $model->created_user_id = $this->user->id;

        $this->card = $this->user->getActiveCreditCard();

        if (!$this->card) {
            throw new UserNotHasActiveCreditCardException();
        }

        $model->code = Coupon::generateCode();
        if ($model->save()) {
            $this->createTransaction($model->sum);
            $this->doPayment($model->sum);

            return $model->code;
        }
        throw new \Exception("Couldn't save coupon");
    }

    private function createTransaction($amount) {
        $this->transaction = new CardTransaction();
        $this->transaction->credit_card_id = $this->card->id;
        $this->transaction->user_id = $this->user->id;
        $this->transaction->type = CardTransaction::TYPE_COUPON;
        $this->transaction->is_done = false;
        $this->transaction->is_returned = false;
        $this->transaction->sum_transaction = $amount;
        $this->transaction->save();
    }

    private function doPayment($amount) {
        MakeTransactionService::do($this->card, $this->transaction, [
            'Amount' => $amount, // Required
            'Currency' => 'KZT', // Required
            'Name' => $this->user->name, // Required
            'IpAddress' => $this->card->ip, // Required
            'Token' => $this->card->card_token, // Required
            'InvoiceId' => $this->transaction->id,
            'Description' => 'Payment for coupon on ' . $amount . 'KZT',
            'AccountId' => $this->user->id,
            'Email' => $this->card->email
        ]);
    }
}
