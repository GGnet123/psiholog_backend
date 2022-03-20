<?php
namespace App\Services;

use App\Exceptions\Finance\CantFindActiveTransactionToReturnMoneyException;
use App\Exceptions\Finance\UserNotHasActiveCreditCardException;
use App\Models\Finance\CardTransaction;
use App\Models\Finance\CreditCard;
use App\Models\Main\Subscription;
use App\Models\Record\RecordDoctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DeclineRecordTransactionSerivce {
    private RecordDoctor $record;
    private CardTransaction $transaction;

    static function do(RecordDoctor $record){
        $el = new DeclineRecordTransactionSerivce();
        $el->start($record);
    }

    function start(RecordDoctor $record){
        $this->record = $record;
        $this->findTransaction();

        CancelTransactionService::do($this->transaction);

    }

    private function findTransaction(){
        $this->transaction = CardTransaction::where(['user_id' => $this->record->customer_id,
                                                    'record_id' => $this->record->id,
                                                    'is_done' => true])->first();

        if (!$this->transaction)
            throw new CantFindActiveTransactionToReturnMoneyException();
    }



}
