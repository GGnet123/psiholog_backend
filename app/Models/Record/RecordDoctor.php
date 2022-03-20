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
        'is_moved' => 'boolean',
        'doctor_name' => 'function',
        'customer_name' => 'function'
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
    CONST ON_WORK_STATUS = 3;
    CONST DONE_STATUS = 4;
    CONST DECLINE_BY_DOCTOR = 5;
    CONST DECLINE_BY_SYSTEM = 6;

    static $ar_status_ru = [];

    static function getArStatus () : array
    {
        return [
            STATIC::CREATED_STATUS => 'CREATED. need approve',
            STATIC::APPROVED_STATUS => 'APPROVED. waiting seance',
            STATIC::ON_WORK_STATUS => 'ON_WORK. seance is begin',
            STATIC::DONE_STATUS => 'DONE. seance is finished',
            STATIC::DECLINE_BY_DOCTOR => 'DECLINE_BY_DOCTOR. doctor is decline approve',
            STATIC::DECLINE_BY_SYSTEM => 'DECLINE_BY_SYSTEM. system is decline approve. if moment for approve expired',
        ];
    }

    function scopeDoctorName($q, $name){
        return $q->whereHas('relDoctor', function($b) use ($name){
            $b->where('name', 'like', $name);
        });
    }

    function scopeCustomerName($q, $name){
        return $q->whereHas('relCustomer', function($b) use ($name){
            $b->where('name', 'like', $name);
        });
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

    function relLogs(){
        return $this->hasMany(RecordLog::class, 'record_id');
    }

    function getRecordStrAttribute(){
        return $this->record_date.' '.$this->record_time;
    }

    function getArStatusRuAttribute(){
        if (count(static::$ar_status_ru) > 0)
            return static::$ar_status_ru;

        static::$ar_status_ru = [];
        foreach (RecordDoctor::getArStatus() as $status_id => $v){
            static::$ar_status_ru[$status_id] = $this->label('status_'.$status_id);
        }

        return static::$ar_status_ru;
    }

    function getStatusRuAttribute(){
        return (isset($this->ar_status_ru[$this->status_id]) ? $this->ar_status_ru[$this->status_id] : null);
    }

}
