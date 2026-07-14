<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year ?? date('Y');

        $months = [];

        for ($i = 1; $i <= 12; $i++) {

            $months[] = [

                'number' => $i,

                'name' => date('F', mktime(0,0,0,$i,1)),

                'patients' => Patient::whereYear('registration_date',$year)
                    ->whereMonth('registration_date',$i)
                    ->count()

            ];

        }

        return view('calendar.index', compact('year','months'));
    }
}
