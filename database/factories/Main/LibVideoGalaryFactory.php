<?php

namespace Database\Factories\Main;

use App\Models\Main\LibMusicGalary;
use App\Models\Main\LibVideoGalary;
use App\Models\Services\UploaderFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Main\LibSpecialization>
 */
class LibVideoGalaryFactory extends Factory
{
    protected $model = LibVideoGalary::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = UploaderFile::where('type_id', UploaderFile::IMAGE)->first();

        return [
            'name' => $this->faker->name(),
            'name_en' => $this->faker->name().'_en',
            'is_free' => $this->faker->boolean,
            'photo_id' => $file ? $file->id : null
        ];
    }
}
