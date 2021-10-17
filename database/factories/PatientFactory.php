<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'birthdate' => $this->faker->dateTimeBetween('1970-01-01', '1980-12-31')->format('Y-m-d'),
            'sex' => $this->faker->randomElement(['male', 'female']),
            'nurse_id' => function ()
            {
                return User::factory()->create()->id;
            }
        ];
    }
}
