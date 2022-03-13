<?php
namespace App\Models\Record;

use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Model;

class RecordLog extends Model {
    use LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'log_record';
    protected $fillable = [
        'record_id', 'status_id', 'is_moved', 'is_canceled', 'user_id', 'record_json'];

    protected $ar_filter = [
        'record_id' => 'int',
        'status_id' => 'int',
        'is_canceled' => 'boolean',
        'is_moved' => 'boolean',
        'user_id' => 'int'
    ];

    protected $casts = [

        'record_id' => 'integer',
        'status_id' => 'integer',
        'is_canceled' => 'boolean',
        'is_moved' => 'boolean',
        'user_id' => 'integer',
        'record_json' => 'json'
    ];

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function relRecord(){
        return $this->belongsTo(RecordDoctor::class, 'record_id');
    }
}
