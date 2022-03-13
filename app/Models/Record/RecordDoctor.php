<?php
namespace App\Models\Record;

use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Model;

class RecordDoctor extends Model {
    use LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'record_doctor';
    protected $fillable = [
        'customer_id', 'doctor_id', 'sum', 'record_date',
        'record_time', 'status_id', 'is_canceled', 'is_moved'];

    protected $ar_filter = [
        'customer_id' => 'int',
        'doctor_id' => 'int',
        'sum' => 'int',
        'record_date' => 'string',
        'record_time' => 'string',
        'status_id' => 'int',
        'is_canceled' => 'boolean',
        'is_moved' => 'boolean'
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'doctor_id' => 'integer',
        'sum' => 'integer',
        'record_date' => 'date',
        'status_id' => 'int',
        'is_canceled' => 'boolean',
        'is_moved' => 'boolean'
    ];

    CONST CREATED_STATUS = 1;
    CONST APPROVED_STATUS = 2;
    CONST PAYED_STATUS = 3;
    CONST ON_WORK_STATUS = 4;
    CONST DONE_STATUS = 5;

    static function getArStatus () : array
    {
        return [
            STATIC::CREATED_STATUS => 'CREATED. need approve',
            STATIC::APPROVED_STATUS => 'APPROVED. need pay',
            STATIC::PAYED_STATUS => 'PAYED. wait seance',
            STATIC::ON_WORK_STATUS => 'ON_WORK. seance is begin',
            STATIC::DONE_STATUS => 'DONE. seance is finished',
        ];
    }

    function getStatusNameAttribute(){
        $ar_status = static::getArStatus();
        if (!isset($ar_status[$this->status_id]))
            return null;

        return $ar_status[$this->status_id];
    }

    function relCustomer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    function relDoctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

}
