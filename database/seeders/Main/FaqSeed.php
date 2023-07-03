<?php

namespace Database\Seeders\Main;

use App\Models\Main\Faq;
use Illuminate\Database\Seeder;

class FaqSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Faq::count())
            return;

        Faq::factory(30)->create();
    }
}
