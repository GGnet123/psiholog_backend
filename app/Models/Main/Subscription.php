<?php
namespace App\Models\Main;

use App\Models\Record\RecordDoctor;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {
    use LabelModelTrait, SortModelTrait, FilterModelTrait;
    protected $table = 'subscription';
    protected $fillable = [
        'user_id', 'is_active', 'date_e', 'by_month', 'by_year'
    ];

    CONST COST_MONTH = 1500;
    CONST COST_YEAR = 9500;

    protected $ar_filter = [
        'is_active' => 'boolean_str',
        'user_id' => 'int',
        'date_e' => 'string',
        'user_name' => 'function'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'by_month' => 'boolean',
        'by_year' => 'boolean',
        'date_e' => 'date'
    ];

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function scopeUserName($q, $name){
        return $q->whereHas('relUser', function($b) use ($name){
            $b->where('name', 'like', $name);
        });
    }

    function getTypeRuAttribute(){
        if ($this->by_month)
            return $this->label('by_month');

        return $this->label('by_year');
    }

}
