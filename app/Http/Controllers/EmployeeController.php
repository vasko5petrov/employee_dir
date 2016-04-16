<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Department;
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
    
    //Show a employee details
    public function show($id) 
    {
        $em = Employee::find($id);
        $em->department_name = Department::find($em->department_id)->name;
        return view('employee.showEmployeeDetails', compact('em'));
    }
}
