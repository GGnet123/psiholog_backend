<?php

namespace Database\Factories\Main;

use App\Models\Main\LibSpecialization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Main\LibSpecialization>
 */
class LibSpecializationFactory extends Factory
{
    protected $model = LibSpecialization::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'name_en' => $this->faker->name().'_en'
        ];
    }
}
