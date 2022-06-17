<?php

namespace Database\Factories\Main;

use App\Models\Main\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'name_en' => $this->faker->name().'_en',
            'note' => $this->faker->text,
            'note_en' => 'EN__'.$this->faker->text.'_en'
        ];
    }
}
