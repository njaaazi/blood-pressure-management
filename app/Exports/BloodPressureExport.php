<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class BloodPressureExport implements FromQuery
{
    use Exportable;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return $this->patient->bloodPressure();
    }
}
