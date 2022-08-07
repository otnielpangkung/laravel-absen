<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Branch;
use App\Models\TypeAbsen;
use App\Models\Employee;
use App\Models\Absen;

class WebController extends Controller
{
    //
    public function getEmployee(Request $request) {

        $query = Employee::select('*');
    }

    
}
