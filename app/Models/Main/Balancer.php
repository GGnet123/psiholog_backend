<?php
namespace App\Models\Main;

use App\Models\Record\RecordDoctor;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Model;

class Balancer extends Model {
    use LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'balancer';
    protected $fillable = [
        'is_done', 'is_canceled', 'user_id', 'sum', 'record_id', 'subscription_id', 'need_returned', 'is_returned'];

    protected $ar_filter = [
        'is_done' => 'boolean',
        'is_canceled' => 'boolean',
        'user_id' => 'int',
        'sum' => 'int',
        'record_id' => 'int',
        'subscription_id' => 'int',
        'need_returned' => 'boolean',
        'is_returned' => 'boolean',
    ];

    protected $casts = [
        'is_canceled' => 'boolean',
        'is_moved' => 'boolean',
        'sum' => 'integer',
        'need_returned' => 'boolean',
        'is_returned' => 'boolean',
    ];

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function relRecord(){
        return $this->belongsTo(RecordDoctor::class, 'record_id');
    }
}
