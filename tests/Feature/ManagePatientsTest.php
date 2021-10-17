<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagePatientsTest extends TestCase
{

    use WithFaker, RefreshDatabase, HasFactory;

    public function test_guests_cannot_manage_patients()
    {
        $patient = Patient::factory()->create();

        $this->get('dashboard/patients')->assertRedirect('login');
        $this->get('dashboard/patients/create')->assertRedirect('login');
        $this->get($patient->path())->assertRedirect('login');
        $this->post('dashboard/patients', $patient->toArray())->assertRedirect('login');
    }

    public function test_a_nurse_can_create_a_patient()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $this->get('/dashboard/patients/create')->assertStatus(200);

        $attributes = [
            'name'      => $this->faker->name,
            'birthdate' => $this->faker->dateTimeBetween('1970-01-01', '1990-12-31')
                ->format('d/m/Y'),
            'sex'       => $this->faker->randomElement(['male', 'female'])
        ];

        $this->post('dashboard/patients', $attributes)->assertRedirect('dashboard/patients');

        $this->assertDatabaseHas('patients', $attributes);

        $this->get('dashboard/patients')->assertSee($attributes['name']);
    }

    public function test_a_nurse_can_view_their_patient()
    {
        $this->be(User::factory()->create());

        $this->withoutExceptionHandling();

        $patient = Patient::factory()->create(['nurse_id' => auth()->id()]);
//dd($patient->path());
        $this->get($patient->path())
            ->assertSee($patient->name)
            ->assertSee($patient->birthdate)
            ->assertSee(ucfirst($patient->sex));
    }

    public function test_an_authenticated_nurse_cannot_view_the_projects_of_others()
    {
        $this->be(User::factory()->create());

        $patient = Patient::factory()->create();

        $this->get($patient->path())->assertStatus(403);
    }

    public function test_a_patient_requires_a_name()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Patient::factory()->raw(['name' => '']);
        $this->post('dashboard/patients', $attributes)->assertSessionHasErrors('name');
    }

    public function test_a_patient_requires_a_birthdate()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Patient::factory()->raw(['birthdate' => '']);
        $this->post('dashboard/patients', $attributes)->assertSessionHasErrors('birthdate');
    }

    public function test_a_patient_requires_a_gender()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Patient::factory()->raw(['sex' => '']);
        $this->post('dashboard/patients', $attributes)->assertSessionHasErrors('sex');
    }

}
