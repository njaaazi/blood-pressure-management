<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Id')
                ->sortable()
                ->searchable(),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Birthdate')
                ->sortable()
                ->searchable(),
            Column::make('Sex')
                ->sortable()
                ->searchable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('patients.show', $row);
    }

    public function query(): Builder
    {
        return Patient::query()->where(['nurse_id' => auth()->user()->id]);
    }
}
