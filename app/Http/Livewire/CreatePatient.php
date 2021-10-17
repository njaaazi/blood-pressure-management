<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;

class CreatePatient extends Component
{
    public bool $showModal = false;
    public string $name = '';
    public string $sex = '';
    public $birthdate;


    protected $rules = [
        'name'      => 'required',
        'birthdate' => 'required',
        'sex'       => 'required',
    ];

    public function create()
    {
        $this->validate();

        auth()->user()->patients()->create(
            [
                'name'      => $this->name,
                'birthdate' => $this->birthdate,
                'sex'       => $this->sex
            ]
        );

        session()->flash('message', 'Patient successfully created.');

        return redirect()->route('patients');
    }

    public function render()
    {
        return view('livewire.create-patient');
    }
}
