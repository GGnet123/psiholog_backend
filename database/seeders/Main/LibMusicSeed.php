<?php

namespace Database\Seeders\Main;

use App\Models\Main\LibMusicGalary;
use Illuminate\Database\Seeder;

class LibMusicSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (LibMusicGalary::count())
            return;

        LibMusicGalary::factory(10)->create();
    }
}
