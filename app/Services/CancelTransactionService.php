<?php
namespace App\Services;

use Albakov\LaravelCloudPayments\Facade as CloudPay;
use App\Models\Finance\CardTransaction;

class CancelTransactionService {
    static function do(CardTransaction $transaction){
        $res = CloudPay::transactionsRefund(['TransactionId' => $transaction->transaction_id, 'Amount' => $transaction->sum_transaction]);
    }
}
