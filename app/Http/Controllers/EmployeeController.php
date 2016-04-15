<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeeController extends Controller
{
    // show list of employees
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }
}
