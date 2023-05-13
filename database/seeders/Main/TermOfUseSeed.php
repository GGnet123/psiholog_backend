<?php

namespace Database\Seeders\Main;

use App\Models\Main\Faq;
use App\Models\Main\TermOfUse;
use Illuminate\Database\Seeder;

class TermOfUseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (TermOfUse::count())
            return;

        TermOfUse::factory(1)->create();
    }
}
