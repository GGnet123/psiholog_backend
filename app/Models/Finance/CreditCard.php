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

class CreditCard extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait, Notifiable;
    protected $table = 'credit_cards';
    protected $fillable = [
        'user_id',
        'card_crypto',
        'card_token',
        'is_accepted',
        'is_3d_secure',
        'is_active',
        'is_removed',
        'last_response',
        'note',
        'first_symbol',
        'last_symbol',
        'email',
        'data_to_check_3d_secure',
        'ip'
    ];

    protected $ar_filter = [
        'user_id' => 'int',
        'note' => 'string',
    ];

    protected $casts = [
        'is_accepted' => 'boolean',
        'is_3d_secure' => 'boolean',
        'is_active' => 'boolean',
        'is_removed' => 'boolean',
        'last_response' => 'array',
        'data_to_check_3d_secure' => 'array'
    ];


    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }



}
