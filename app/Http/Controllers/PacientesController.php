<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consentimiento;
use App\Models\Group;

class PacientesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $patients = Patient::when($search, function ($query) use ($search) {
            $query->whereRaw("CONCAT(TRIM(name), ' ', TRIM(last_name)) LIKE ?", ["%{$search}%"]);
        })
            ->orderBy('registration_date', 'desc')
            ->paginate(10);

        return view('pacientes.index', compact('patients'));
    }

    public function mes($year,$mes)
{

    $patients = Patient::whereYear('registration_date',$year)
        ->whereMonth('registration_date',$mes)
        ->orderBy('registration_date','desc')
        ->paginate(10);

    $nombreMes = [

        1=>'January',
        2=>'February',
        3=>'March',
        4=>'April',
        5=>'May',
        6=>'June',
        7=>'July',
        8=>'August',
        9=>'September',
        10=>'October',
        11=>'November',
        12=>'December'

    ];

    return view('pacientes.index',[

        'patients'=>$patients,

        'titulo'=>'Patients registered in '.$nombreMes[$mes].' '.$year

    ]);

}

public function assignGroup(Request $request, Patient $patient)
{
    $request->validate([
        'group_id' => 'required|exists:groups,id',
    ]);

    $patient->update([
        'group_id' => $request->group_id,
    ]);

    return back()->with('success', 'Patient assigned to group successfully.');
}
}
