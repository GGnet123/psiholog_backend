<?php

namespace Database\Seeders\Main;

use App\Models\Main\LibMusicGalary;
use App\Models\Main\LibVideoGalary;
use Illuminate\Database\Seeder;

class LibVideoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (LibVideoGalary::count())
            return;

        LibVideoGalary::factory(10)->create();
    }
}
