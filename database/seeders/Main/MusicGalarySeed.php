<?php

namespace Database\Seeders\Main;

use App\Models\Main\LibMusicGalary;
use App\Models\Main\MusicGalary;
use Illuminate\Database\Seeder;

class MusicGalarySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (MusicGalary::count())
            return;

        MusicGalary::factory(20)->create();
    }
}
