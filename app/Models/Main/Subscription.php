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
        'user_id', 'is_active', 'date_e'];

    protected $ar_filter = [
        'is_active' => 'boolean',
        'user_id' => 'int',
        'date_e' => 'string'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_active' => 'date'
    ];

    function relUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
