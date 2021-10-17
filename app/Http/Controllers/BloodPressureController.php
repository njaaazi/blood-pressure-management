<?php

namespace App\Http\Controllers;

use App\Exports\BloodPressureExport;
use App\Models\Patient;
use Maatwebsite\Excel\Facades\Excel;

class BloodPressureController extends Controller
{

    public function export(Patient $patient)
    {
        return Excel::download(new BloodPressureExport($patient), 'blood-pressure.csv');
    }
}
