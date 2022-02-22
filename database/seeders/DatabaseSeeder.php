<?php

namespace Database\Seeders;

use Database\Seeders\Main\FaqSeed;
use Database\Seeders\Main\LibMusicSeed;
use Database\Seeders\Main\LibSpecialiationSeed;
use Database\Seeders\Main\LibVideoSeed;
use Database\Seeders\Main\TermOfUseSeed;
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
            FaqSeed::class,
            TermOfUseSeed::class,
            LibMusicSeed::class,
            LibVideoSeed::class
        ]);
    }
}
