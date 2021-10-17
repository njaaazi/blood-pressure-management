<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class CreateBloodPressure extends Component
{
    public $patient;
    public bool $showModal = false;
    public int $systolic = 0;
    public int $diastolic = 0;


    protected $rules = [
        'systolic'  => 'required|numeric|gt:0',
        'diastolic' => 'required|numeric|gt:0',
    ];

    public function mount()
    {
//        $this->patient = new Patient();
    }

    public function createBloodPressure(Patient $patient)
    {
        $this->patient = $patient;

        $this->validate();

        $this->patient->bloodPressure()->create(
            [
                'systolic'  => $this->systolic,
                'diastolic' => $this->diastolic,
            ]
        );

        session()->flash('message', 'Blood pressure info successfully created.');

        $this->showModal = false;

        return redirect()->to("/dashboard/patients/{$this->patient->id}");
    }

    public function render()
    {
        return view('livewire.create-blood-pressure');
    }
}
