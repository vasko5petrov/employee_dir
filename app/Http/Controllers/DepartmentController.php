<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;

use Illuminate\Http\Request;

use App\Http\Requests;

class DepartmentController extends Controller
{
    // show list of departments
    public function index()
    {
        $departments = Department::all();
        $departments = $departments->sortBy('name')->values()->all();
        return view('department.index', compact('departments'));
    }

    // Return form: Add a new department
    public function addForm()
    {
        $employees = Employee::all();
        $employees = $employees->sortBy('name');
        return view('department.addDepartmentForm', compact('employees'));
    }

    // Add a new department
    // Need to be enhanced with validation
    public function add(Request $request)
    {
        $dp_name = $request->input('dp-name');
        $dp_office_number = $request->input('dp-office-number');
        $dp_manager_id = $request->input('dp-manager-id');

        if ($dp_name != '' && $dp_office_number != '' && is_numeric($dp_manager_id)) {
            $dp = new Department();
            $dp->name = $dp_name;
            $dp->office_number = $dp_office_number;
            $dp->manager_id = $dp_manager_id;
            $dp->save();

            $result = 'New department successfully added!';
            $alert_type = 'success';
        }
        else {
            $result = "Something's wrong. Check your input!";
            $alert_type = 'warning';
        }
        return view('department.addDepartmentResult', compact('result', 'alert_type'));
    }
}
