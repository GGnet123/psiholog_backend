<?php

namespace Database\Factories\Main;

use App\Models\Main\LibVideoGalary;
use App\Models\Main\VideoGalary;
use App\Models\Services\UploaderFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Main\LibSpecialization>
 */
class VideoGalaryFactory extends Factory
{
    protected $model = VideoGalary::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = UploaderFile::where('type_id', UploaderFile::IMAGE)->first();
        $video = UploaderFile::where('type_id', UploaderFile::VIDEO)->first();
        $cat = LibVideoGalary::inRandomOrder()->first();

        return [
            'name' => $this->faker->name(),
            'name_en' => $this->faker->name().'_en',
            'is_free' => $this->faker->boolean,
            'photo_id' => $file ? $file->id : null,
            'cat_id' => $cat ? $cat->id : null,
            'video_id' => $video ? $video->id : null,
        ];
    }
}
