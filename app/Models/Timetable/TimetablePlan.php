<?php
namespace App\Models\Timetable;

use App\Models\Services\UploaderFile;
use App\Traits\FilterModelTrait;
use Illuminate\Database\Eloquent\Model;

class TimetablePlan extends Model {
    use FilterModelTrait;

    protected $table = 'timetable_plan';
    protected $fillable = ['user_id', 'day_01', 'day_02','day_03','day_04','day_05','day_06','day_07',
                            'hour_00',  'hour_01',  'hour_02',  'hour_03',  'hour_04',
                            'hour_05',  'hour_07',  'hour_08',  'hour_09',  'hour_10',  'hour_11',  'hour_12',  'hour_13',
                            'hour_14',  'hour_15',  'hour_16',  'hour_17',  'hour_18',  'hour_19',  'hour_20',  'hour_21',
                            'hour_22',  'hour_23'];

    protected $casts = [
        'day_01' => 'boolean',   'day_02' => 'boolean',  'day_03' => 'boolean', 'day_04' => 'boolean',  'day_05' => 'boolean',
        'day_06' => 'boolean',   'day_07' => 'boolean',
        'hour_00' => 'boolean',  'hour_01' => 'boolean',  'hour_02' => 'boolean', 'hour_03' => 'boolean',  'hour_04' => 'boolean',
        'hour_05' => 'boolean',  'hour_07' => 'boolean',  'hour_08' => 'boolean', 'hour_09' => 'boolean',  'hour_10' => 'boolean',
        'hour_11' => 'boolean',  'hour_12' => 'boolean',  'hour_13' => 'boolean', 'hour_14' => 'boolean',  'hour_15' => 'boolean',
        'hour_16' => 'boolean',  'hour_17' => 'boolean',  'hour_18' => 'boolean', 'hour_19' => 'boolean',  'hour_20' => 'boolean',
        'hour_21' => 'boolean',  'hour_22' => 'boolean',  'hour_23' => 'boolean'
    ];

    protected $ar_filter = [
        'day_01' => 'boolean',   'day_02' => 'boolean',  'day_03' => 'boolean', 'day_04' => 'boolean',  'day_05' => 'boolean',
        'day_06' => 'boolean',   'day_07' => 'boolean',
        'hour_00' => 'boolean',  'hour_01' => 'boolean',  'hour_02' => 'boolean', 'hour_03' => 'boolean',  'hour_04' => 'boolean',
        'hour_05' => 'boolean',  'hour_07' => 'boolean',  'hour_08' => 'boolean', 'hour_09' => 'boolean',  'hour_10' => 'boolean',
        'hour_11' => 'boolean',  'hour_12' => 'boolean',  'hour_13' => 'boolean', 'hour_14' => 'boolean',  'hour_15' => 'boolean',
        'hour_16' => 'boolean',  'hour_17' => 'boolean',  'hour_18' => 'boolean', 'hour_19' => 'boolean',  'hour_20' => 'boolean',
        'hour_21' => 'boolean',  'hour_22' => 'boolean',  'hour_23' => 'boolean'
    ];

}