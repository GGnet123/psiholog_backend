<?php

namespace Database\Seeders;

use Database\Seeders\Main\FaqSeed;
use Database\Seeders\Main\LibMusicSeed;
use Database\Seeders\Main\LibSpecialiationSeed;
use Database\Seeders\Main\LibVideoSeed;
use Database\Seeders\Main\MusicGalarySeed;
use Database\Seeders\Main\TermOfUseSeed;
use Database\Seeders\Main\TestVideoAndMusicSampleSeed;
use Database\Seeders\Main\VideoGalarySeed;
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
            LibVideoSeed::class,
            TestVideoAndMusicSampleSeed::class,
            MusicGalarySeed::class,
            VideoGalarySeed::class
        ]);
    }
}
