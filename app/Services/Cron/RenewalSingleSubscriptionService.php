<?php
namespace App\Services\Cron;

use App\Events\ErrorPaySubscriptionEvent;
use App\Models\Main\Subscription;
use App\Services\CreateSubscriptionTransactionService;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RenewalSingleSubscriptionService {
    private Subscription $subscription;
    private Subscription $new_subscription;

    static function do(Subscription $subscription){
        $el = new RenewalSingleSubscriptionService();
        $el->start($subscription);
    }

    function start(Subscription $subscription){
        $this->subscription = $subscription;

        $this->createNewSubscription();

        try {
            CreateSubscriptionTransactionService::do($subscription->relUser, $this->new_subscription);
            $this->acceptNewSubscription();
        } catch (\Exception $e) {
            $this->cancelNewSubscription();

            event(new ErrorPaySubscriptionEvent($this->subscription));

            Log::error($e);
        }
    }

    function createNewSubscription(){
        $record = new Subscription();

        $now = new DateTime();

        if ($this->subscription->by_month) {
            $record->by_month = true;
            $now->modify('next month');
        }
        else {
            $record->by_year = true;
            $now->modify('next year');
        }

        $record->user_id = $this->subscription->user_id;
        $record->is_active = true;
        $record->date_e = $now->format('Y-m-d');
        $record->save();

        $this->new_subscription = $record;
    }

    private function cancelNewSubscription(){
        $this->new_subscription->delete();

        $this->subscription->update([
            'is_cancel_by_system' => true,
            'is_active' => false
        ]);
    }

    private function acceptNewSubscription(){
        $this->subscription->update([
            'is_active' => false
        ]);
    }

}
