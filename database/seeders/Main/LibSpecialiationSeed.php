<?php

namespace Database\Seeders\Main;

use App\Models\Main\LibSpecialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibSpecialiationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (LibSpecialization::count())
            return;

        LibSpecialization::factory(10)->create();
    }
}
