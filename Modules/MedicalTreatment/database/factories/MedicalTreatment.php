<?php

namespace Modules\MedicalTreatment\database\factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\MedicalTreatment\Models\MedicalTreatment>
 */
class MedicalTreatmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\MedicalTreatment\Models\MedicalTreatment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => substr($this->faker->text(15), 0, -1),
            'slug' => '',
            'description' => $this->faker->paragraph,
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'type' => $this->faker->randomElement(['Medical Service', 'Medical Product']),
            'intro' => $this->faker->paragraph,
            'benefits' => $this->faker->paragraph,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'meta_keywords' => $this->faker->words(3, true),
            'image' => $this->faker->imageUrl(),
        ];
    }
}