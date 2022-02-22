<?php
namespace App\Models\Profile;

use App\Models\Services\UploaderFile;
use Illuminate\Database\Eloquent\Model;

class UserCertificat extends Model {
    protected $table = 'users_sertificats';
    protected $fillable = ['user_id', 'sertificat_id'];

    function relCertificat(){
        return $this->belongsTo(UploaderFile::class, 'sertificat_id');
    }
}