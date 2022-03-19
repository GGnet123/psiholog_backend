<?php
namespace App\Services;

use App\Exceptions\Finance\UserNotHasActiveCreditCardException;
use App\Models\Finance\CardTransaction;
use App\Models\Finance\CreditCard;
use App\Models\Main\Subscription;
use App\Models\Record\RecordDoctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CreateRecordTransactionService {
    private User $user;
    private RecordDoctor $record;
    private CreditCard $card;
    private CardTransaction $transaction;

    static function do(User $user, RecordDoctor $record){
        $el = new CreateRecordTransactionService();
        $el->pay($user, $record);
    }

    function pay(User $user, RecordDoctor $record){
        if (!$user->hasActiveCreditCard())
            throw new UserNotHasActiveCreditCardException();

        $this->user = $user;
        $this->record = $record;
        $this->card = $user->getActiveCreditCard();


        $this->createTransactionItem();
        $this->doPayment();
    }

    private function createTransactionItem(){
        $this->transaction = new CardTransaction();
        $this->transaction->credit_card_id = $this->card->id;
        $this->transaction->user_id = $this->user->id;
        $this->transaction->type = CardTransaction::TYPE_RECORD;
        $this->transaction->record_id = $this->record->id;
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
            'Description' => 'Payment for record №' . $this->transaction->id,
            'AccountId' => $this->user->id,
            'Email' => $this->card->email
        ]);
    }

    private function getAmount(){
        return $this->record->sum;
    }


}
