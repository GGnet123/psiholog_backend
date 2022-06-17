<?php

namespace App\Models;

use App\Models\Finance\CreditCard;
use App\Models\Main\LibSpecialization;
use App\Models\Profile\UserCertificat;
use App\Models\Profile\UserSpecialization;
use App\Models\Profile\UserVideo;
use App\Models\Services\UploaderFile;
use App\Models\Timetable\TimetablePlan;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FilterModelTrait, SortModelTrait, LabelModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login',
        'password',
        'type_id',
        'lang',
        'date_b',
        'avatar_id',
        'note',
        'price',
        'notify_all',
        'notify_meditation',
        'notify_app',
        'is_blocked',
        'is_blocked_seance',
        'fcm_token',
        'card_data'
    ];

    CONST ADMIN_TYPE = 1;
    CONST DOCTOR_TYPE = 2;
    CONST USER_TYPE = 3;
    CONST NOTE_FINISHED_TYPE = 4;

    CONST EN_LANG = 'en';
    const RU_LANG = 'ru';

    protected $ar_filter = [
        'name' => 'string',
        'price' => 'int',
        'specialization_id' => 'function',
        'specialization_array' => 'function',
        'price_b' => 'function',
        'price_e' => 'function',
        'is_blocked' => 'boolean'
    ];

    protected $ar_sort = [
        'name',
        'login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'price' => 'integer',
        'notify_all' => 'boolean',
        'notify_meditation' => 'boolean',
        'notify_app' => 'boolean',
        'date_b' => 'date',
        'is_blocked' => 'boolean',
        'is_blocked_seance' => 'boolean'
    ];

    function scopeSpecializationId($q, $id){
        $q->whereHas('relSpecilization', function($b) use ($id){
            $b->where('lib_specialization_id', $id);
        });
    }

    function scopeSpecializationArray($q, $ar){
        $q->whereHas('relSpecilization', function($b) use ($ar){
            $b->whereIn('lib_specialization_id', $ar);
        });
    }


    public function routeNotificationForFcm(){
        return [$this->fcm_token];
    }

    function scopePriceB($q, $price){
        $q->where('price', '>=', $price);
    }

    function scopePriceE($q, $price){
        $q->where('price', '<=', $price);
    }

    function scopeDoctor($q){
        $q->where('type_id', static::DOCTOR_TYPE);
    }

    function scopeSimpleUser($q){
        $q->where('type_id', static::USER_TYPE);
    }

    function isAdmin():bool {
        return $this->type_id == STATIC::ADMIN_TYPE;
    }

    function isDoctor():bool {
        return $this->type_id == STATIC::DOCTOR_TYPE;
    }

    function isUser():bool {
        return $this->type_id == STATIC::USER_TYPE;
    }

    function isNoteFinishRegistration():bool {
        return $this->type_id == STATIC::NOTE_FINISHED_TYPE;
    }

    function relAvatar() {
        return $this->belongsTo(UploaderFile::class, 'avatar_id');
    }

    function relTimetablePlan(){
        return $this->hasOne(TimetablePlan::class, 'user_id');
    }

    function relCertificat(){
        return $this->hasMany(UserCertificat::class, 'user_id');
    }

    function relVideo(){
        return $this->hasMany(UserVideo::class, 'user_id');
    }

    function relSpecilization(){
        return $this->hasMany(UserSpecialization::class, 'user_id');
    }

    function relSpecilizationMain(){
        return $this->belongsToMany(LibSpecialization::class, 'users_specialization', 'user_id', 'lib_specialization_id');
    }

    function relCertificatsMain(){
        return $this->belongsToMany(UploaderFile::class, 'users_sertificats', 'user_id', 'sertificat_id');
    }

    function relVideoMain(){
        return $this->belongsToMany(UploaderFile::class, 'users_video', 'user_id', 'video_id');
    }

    function generateDefPlan(){
        $item = TimetablePlan::where(['user_id' => $this->id])->first();
        if (!$item)
            TimetablePlan::create(['user_id' => $this->id]);

    }

    function relCreditCards(){
        return $this->hasMany(CreditCard::class, 'user_id');
    }

    function hasActiveCreditCard(){
        $item = $this->relCreditCards()->where(['is_active' => true, 'is_removed'=> false])->count();
        return ($item ? true : false);
    }

    function getActiveCreditCard(){
        return $this->relCreditCards()->where(['is_active' => true, 'is_removed'=> false])->first();
    }
}
