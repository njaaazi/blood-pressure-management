<?php

namespace Database\Factories;

use App\Models\BloodPressure;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodPressureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BloodPressure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'systolic' => $this->faker->numberBetween(100, 180),
            'diastolic' => $this->faker->numberBetween(60, 90),
            'patient_id' => function ()
            {
                return Patient::factory()->create()->id;
            }
        ];
    }
}
