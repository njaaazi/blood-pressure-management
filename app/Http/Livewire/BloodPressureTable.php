<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\BloodPressure;

class BloodPressureTable extends DataTableComponent
{
    public $patient;

    public function columns(): array
    {
        return [
            Column::make('Id')
                ->sortable()
                ->searchable(),
            Column::make('Systolic')
                ->sortable()
                ->searchable(),
            Column::make('Diastolic')
                ->sortable()
                ->searchable(),

        ];
    }

    public function query(): Builder
    {
        return BloodPressure::query()->where(['patient_id'=> $this->patient->id]);
    }
}
