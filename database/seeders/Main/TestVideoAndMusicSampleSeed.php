<?php

namespace Database\Seeders\Main;

use App\Models\Services\UploaderFile;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\Storage;

class TestVideoAndMusicSampleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (UploaderFile::where('type_id', UploaderFile::MUSIC)->count() == 0){
            $this->insertMusic();
        }

        if (UploaderFile::where('type_id', UploaderFile::VIDEO)->count() == 0){
            $this->insertVideo();
        }

    }

    private function insertMusic(){
        File::copy(public_path('sample.mp3'), storage_path('/app/public/sample.mp3'));

        UploaderFile::create([
            'path' => 'sample.mp3',
            'filesize' => 8589,
            'filename' => 'sample.mp3',
            'extension' => 'mp3',
            'title'=>'sample',
            'type_id' => UploaderFile::MUSIC
        ]);
    }

    private function insertVideo(){
        File::copy(public_path('sample.mp4'), storage_path('/app/public/sample.mp4'));

        UploaderFile::create([
            'path' => 'sample.mp4',
            'filesize' => 8589,
            'filename' => 'sample.mp4',
            'extension' => 'mp4',
            'title'=>'sample',
            'type_id' => UploaderFile::VIDEO
        ]);
    }
}
