<?php

namespace Database\Seeders;

use Database\Seeders\Main\FaqSeed;
use Database\Seeders\Main\LibSpecialiationSeed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LibSpecialiationSeed::class,
            FaqSeed::class
        ]);
    }
}
