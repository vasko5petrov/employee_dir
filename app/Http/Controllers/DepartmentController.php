<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Validation\Validator;
use Symfony\Component\Finder\Iterator\DepthRangeFilterIterator;

class DepartmentController extends Controller
{
    // show list of departments
    public function index()
    {
        $departments = Department::all();
        $departments = $departments->sortBy('name')->values()->all();
        return view('department.index', compact('departments'));
    }

    // show list of employees in this department
    public function employeeList($id)
    {
        $dp = Department::find($id);
        $employees = $dp->employees;
        return view('department.employeeList', compact('dp', 'employees'));
    }

    // Return form: Add a new department
    public function addForm()
    {
        $employees = Employee::all();
        $employees = $employees->sortBy('name');
        return view('department.addDepartmentForm', compact('employees'));
    }

    // Add a new department
    public function add(Request $request)
    {
        // Customize validation messages
        $messages = [
            'dp-name.required' => 'The name field is required.',
            'dp-office-number.required' => 'The office number field is required.',
            'dp-manager-id.required' => 'The manager field is required.',
            'dp-name.string' => 'The name field must be a string.',
            'dp-office-number.string' => 'The office number field must be a string.',
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'dp-name' => 'required|string',
            'dp-office-number' => 'required|string',
            'dp-manager-id' => 'required|integer'
        ], $messages);

        // Insert new department record to DB
        $dp_name = $request->input('dp-name');
        $dp_office_number = $request->input('dp-office-number');
        $dp_manager_id = $request->input('dp-manager-id');

        $dp = new Department();
        $dp->name = $dp_name;
        $dp->office_number = $dp_office_number;
        $dp->manager_id = $dp_manager_id;
        $dp->save();

        // Get list of employee (for selecting manager field)
        $employees = Employee::all();
        $employees = $employees->sortBy('name');
        // Create success flag
        $flag = true;


        return view('department.addDepartmentForm', compact('flag', 'employees'));
    }

    // Return form: Edit a department information
    public function editForm($id)
    {
        $dp = Department::find($id);
        $dp->manager_name = Employee::find($dp->manager_id)->name;
        $employees = $dp->employees;
        return view('department.editDepartmentForm', compact('dp', 'employees'));
    }
    
    // Edit a department information
    // Need to be enhanced with validation
    public function edit(Request $request)
    {
        $dp_id = $request->input('dp-id');
        $new_dp_name = $request->input('dp-name');
        $new_dp_office_number = $request->input('dp-office-number');
        $new_dp_manager_id = $request->input('dp-manager-id');
        if ($dp_id && is_numeric($dp_id)) {
            $dp = Department::find($request->input('dp-id'));

            if ($dp->name === $new_dp_name && $dp->office_number === $new_dp_office_number && $dp->manager_id === $new_dp_manager_id) {
                $result = 'Department information remains unchanged!';
                $alert_type = 'warning';
            }
            elseif ($new_dp_name != '' && $new_dp_office_number != '' && is_numeric($new_dp_manager_id)) {
                $dp->name = $new_dp_name;
                $dp->office_number = $new_dp_office_number;
                $dp->manager_id = $new_dp_manager_id;
                $dp->save();
                $result = 'Department information successfully updated!';
                $alert_type = 'success';
            }
        }
        else {
            $result = "Something's wrong. Check your input!";
            $alert_type = 'warning';
        }
        return view('department.editDepartmentResult', compact('result', 'alert_type', 'dp_id'));
    }

    // Delete a department
    public function delete(Request $request)
    {
        $delete_id = $request->input('dp-id');
        if (is_numeric($delete_id)) {
            $dp = Department::find($delete_id);
            $dp->delete();
        }
        return redirect('/department');
    }
    
    //Show a department details
    public function show($id) 
    {
        $dp = Department::find($id);
        $dp->manager_name = Employee::find($dp->manager_id)->name;
        $number_employees = count($dp->employees);
        return view('department.showDepartmentDetails', compact('dp', 'number_employees'));
    }
}
