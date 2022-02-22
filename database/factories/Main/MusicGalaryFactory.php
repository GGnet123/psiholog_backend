<?php

namespace Database\Factories\Main;

use App\Models\Main\LibMusicGalary;
use App\Models\Main\LibVideoGalary;
use App\Models\Main\MusicGalary;
use App\Models\Services\UploaderFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Main\LibSpecialization>
 */
class MusicGalaryFactory extends Factory
{
    protected $model = MusicGalary::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = UploaderFile::where('type_id', UploaderFile::IMAGE)->first();
        $music = UploaderFile::where('type_id', UploaderFile::MUSIC)->first();
        $cat = LibMusicGalary::inRandomOrder()->first();

        return [
            'name' => $this->faker->name(),
            'name_en' => $this->faker->name().'_en',
            'is_free' => $this->faker->boolean,
            'photo_id' => $file ? $file->id : null,
            'cat_id' => $cat ? $cat->id : null,
            'music_id' => $music ? $music->id : null,
        ];
    }
}
