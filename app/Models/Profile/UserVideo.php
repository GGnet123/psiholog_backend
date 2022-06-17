<?php
namespace App\Models\Profile;

use App\Models\Services\UploaderFile;
use Illuminate\Database\Eloquent\Model;

class UserVideo extends Model {
    protected $table = 'users_video';
    protected $fillable = ['user_id', 'video_id', 'name'];

    function relVideo(){
        return $this->belongsTo(UploaderFile::class, 'video_id');
    }
}