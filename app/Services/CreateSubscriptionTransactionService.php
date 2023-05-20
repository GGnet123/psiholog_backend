<?php
namespace App\Services;

use App\Exceptions\Finance\UserNotHasActiveCreditCardException;
use App\Models\Finance\CardTransaction;
use App\Models\Finance\CreditCard;
use App\Models\Main\Subscription;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateSubscriptionTransactionService {
    private User $user;
    private Subscription $subscription;
    private CreditCard $card;
    private CardTransaction $transaction;

    static function do(User|Authenticatable $user, Subscription $subscription){
        $el = new CreateSubscriptionTransactionService();
        $el->pay($user, $subscription);
    }

    function pay(User $user, Subscription $subscription){
        if (!$user->hasActiveCreditCard())
            throw new UserNotHasActiveCreditCardException();

        $this->user = $user;
        $this->subscription = $subscription;
        $this->card = $user->getActiveCreditCard();


        $this->createTransactionItem();
        $this->doPayment();
    }

    private function createTransactionItem(){
        $this->transaction = new CardTransaction();
        $this->transaction->credit_card_id = $this->card->id;
        $this->transaction->user_id = $this->user->id;
        $this->transaction->type = CardTransaction::TYPE_SUBSCRIPTION;
        $this->transaction->subscription_id = $this->subscription->id;
        $this->transaction->is_done = false;
        $this->transaction->is_returned = false;
        $this->transaction->sum_transaction = $this->getAmount();
        $this->transaction->save();
    }

    private function doPayment(){
        $this->transaction = MakeTransactionService::do($this->card, $this->transaction, [
            'Amount' => $this->getAmount() , // Required
            'Currency' => 'KZT', // Required
            'Name' => $this->user->name, // Required
            'IpAddress' => $this->card->ip, // Required
            'Token' => $this->card->card_token, // Required
            'InvoiceId' => $this->transaction->id,
            'Description' => 'Payment for subscription №' . $this->transaction->id,
            'AccountId' => $this->user->id,
            'Email' => $this->card->email
        ]);
    }

    private function getAmount(){
        if ($this->subscription->by_month)
            return config('finance.cost_subscription_month');


        return config('finance.cost_subscription_year');
    }


}
