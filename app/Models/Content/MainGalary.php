<?php

namespace App\Models\Content;

use App\Models\Services\UploaderFile;
use App\Models\User;
use App\Traits\FilterModelTrait;
use App\Traits\LabelModelTrait;
use App\Traits\SortModelTrait;
use App\Traits\TranslateModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MainGalary extends Model
{
    use HasFactory, TranslateModelTrait, LabelModelTrait, SortModelTrait, FilterModelTrait, Notifiable;
    protected $table = 'content_main_gallery';
    protected $fillable = [
        'cat_id',
        'title',
        'title_en',
        'slug',
        'slog_en',
        'music_id',
        'video_id',
        'image_id',
        'doctor_id',
        'type',
        'need_subscription',
        'notification_ru',
        'notification_en',
        'google_drive_music',
        'google_drive_video'
    ];

    protected $ar_filter = [
        'cat_id' => 'int',
        'title' => 'string',
        'slug' => 'string',
        'doctor_id' => 'int'
    ];

    protected $casts = [
        'need_subscription' => 'boolean'
    ];

    CONST TYPE_NATURE = 'TYPE_NATURE';
    CONST TYPE_TACK_TO_ME = 'TYPE_TACK_TO_ME';
    CONST TYPE_MEDITATION = 'TYPE_MEDITATION';
    CONST TYPE_AFFIRMATION = 'TYPE_AFFIRMATION';
    CONST TYPE_YOGA_TO_ME = 'TYPE_YOGA_TO_ME';
    CONST TYPE_MEDITATION_AUDIO = 'TYPE_MEDITATION_AUDIO';
    CONST TYPE_VDOH = 'TYPE_VDOH';
    CONST TYPE_MANTRA = 'TYPE_MANTRA';
    CONST TYPE_SLEEP = 'TYPE_SLEEP';

    static function getArType(){
        return [
            static::TYPE_NATURE,
            static::TYPE_TACK_TO_ME,
            static::TYPE_MEDITATION,
            static::TYPE_AFFIRMATION,
            static::TYPE_MEDITATION_AUDIO,
            static::TYPE_VDOH,
            static::TYPE_MANTRA,
            static::TYPE_SLEEP,
        ];
    }

    function relDoctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    function relMusic(){
        return $this->belongsTo(UploaderFile::class, 'music_id');
    }

    function relVideo(){
        return $this->belongsTo(UploaderFile::class, 'video_id');
    }

    function relImage(){
        return $this->belongsTo(UploaderFile::class, 'image_id');
    }

    function relCat(){
        return $this->belongsTo(MainGalaryCat::class, 'cat_id');
    }


}
