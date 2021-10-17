<?php

namespace Tests\Unit;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $patient = Patient::factory()->create();

        $this->assertEquals('/dashboard/patients/'. $patient->id, $patient->path());
    }

    public function test_it_belongs_to_a_user()
    {
        $patient = Patient::factory()->create();

        $this->assertInstanceOf(User::class, $patient->nurse);
    }
}
