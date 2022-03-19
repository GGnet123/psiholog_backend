<?php
namespace App\Actions\Main;

use App\Actions\AbstractAction;
use App\Exceptions\Main\HasActiveSubscriptionException;
use App\Models\Main\Subscription;
use App\Services\CreateSubscriptionTransactionService;
use Illuminate\Support\Facades\Auth;

class SaveSubscriptionAction extends AbstractAction {

    protected function do(){
        $record = $this->model;
        $user = Auth::user();

        if (Subscription::where(['user_id'=>$user->id, 'is_active' => true])->first())
            throw new HasActiveSubscriptionException();

        $now = new \DateTime();

        if ($this->data['by_month']) {
            $record->by_month = true;
            $now->modify('next month');
        }
        else {
            $record->by_year = true;
            $now->modify('next year');
        }

        $record->user_id = $user->id;
        $record->is_active = true;
        $record->date_e = $now->format('Y-m-d');
        $record->save();

        CreateSubscriptionTransactionService::do($user, $record);

        return $record;
    }
}
