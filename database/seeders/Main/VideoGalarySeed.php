<?php

namespace Database\Seeders\Main;

use App\Models\Main\VideoGalary;
use Illuminate\Database\Seeder;

class VideoGalarySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (VideoGalary::count())
            return;

        VideoGalary::factory(20)->create();
    }
}
