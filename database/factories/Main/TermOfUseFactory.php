<?php

namespace Database\Factories\Main;

use App\Models\Main\TermOfUse;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermOfUseFactory extends Factory
{
    protected $model = TermOfUse::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note' => $this->faker->text,
            'note_en' => 'EN__'.$this->faker->text.'_en'
        ];
    }
}
