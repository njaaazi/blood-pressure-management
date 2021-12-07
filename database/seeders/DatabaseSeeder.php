<?php

namespace Database\Seeders;

use App\Models\BloodPressure;
use App\Models\Patient;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $nurse = User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
            ]
        );


        /**
         * Slow performance when using
         * eloquent while seeding db.
         */
//        Patient::factory(50000)
//            ->hasBloodPressure(1)
//            ->create(['nurse_id' => $nurse->id]);



        /**
         * Decided to go with this one because of
         * better performance while seeding the db.
         */

        $faker = Factory::create();
        $records = 50000;
        $chunkSize = 1000;

        for ($i=0; $i <  $records; $i++) {
            $patientData[] = [
                'name' => $faker->name(),
                'birthdate' => $faker->dateTimeBetween('1970-01-01', '1980-12-31')->format('Y-m-d'),
                'sex' => $faker->randomElement(['male', 'female']),
                'nurse_id' => $nurse->id,
            ];
        }

        for ($i=1; $i <=  $records; $i++) {
            $bloodPressureData[] = [
                'systolic' => $faker->numberBetween(100, 180),
                'diastolic' => $faker->numberBetween(60, 90),
                'patient_id' => $i,
            ];
        }

        $patientChunks = array_chunk($patientData, $chunkSize);
        $bloodPressureChunks = array_chunk($bloodPressureData, $chunkSize);

        foreach ($patientChunks as $chunk) {
            Patient::insert($chunk);
        }

        foreach ($bloodPressureChunks as $chunk)
        {
            BloodPressure::insert($chunk);
        }
    }
}
