<?php
namespace App\Actions\Main;

use App\Actions\AbstractAction;
use App\Exceptions\Main\HasActiveSubscriptionException;
use App\Exceptions\Main\NoteHasActiveSubscription;
use App\Models\Main\Subscription;
use App\Services\CreateSubscriptionTransactionService;
use Illuminate\Support\Facades\Auth;

class CancelSubscription extends AbstractAction {

    protected function do(){
        $user = Auth::user();

        $this->model = Subscription::where(['user_id'=>$user->id, 'is_active' => true])->first();
        if (!$this->model)
            throw new NoteHasActiveSubscription();


        $this->model->is_cancel_by_user = true;
        $this->model->save();

        return $this->model;
    }
}
