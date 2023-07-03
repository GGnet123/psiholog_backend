<?php

namespace App\Models\Finance;

use App\Models\Services\UploaderFile;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CardTransaction extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait, Notifiable;
    protected $table = 'card_transaction';
    protected $fillable = [
        'credit_card_id',
        'user_id',
        'transaction_id',
        'last_request',
        'last_response',
        'type',
        'subscription_id',
        'record_id',
        'is_done',
        'is_returned',
        'sum_transaction',
        'returned_response'
    ];

    protected $ar_filter = [
        'credit_card_id' => 'int',
        'user_id' => 'int',
        'transaction_id' => 'string',
        'subscription_id' => 'int',
        'record_id' => 'int',
        'is_done' => 'boolean_str',
        'is_returned' => 'boolean_str',
        'user_name' => 'function',
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'is_returned' => 'boolean',
        'last_request' => 'array',
        'last_response' => 'array',
        'returned_response' => 'array'
    ];

    CONST TYPE_SUBSCRIPTION = 1;
    CONST TYPE_RECORD = 2;
    CONST TYPE_COUPON = 3;

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function relCreditCard(){
        return $this->belongsTo(CreditCard::class, 'credit_card_id');
    }

    function scopeUserName($q, $name){
        return $q->whereHas('relUser', function($b) use ($name){
            $b->where('name', 'like', '%'.$name.'%');
        });
    }
}
