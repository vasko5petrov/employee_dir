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
        $departments = Department::orderBy('name')->paginate(8);
        
        // Get list of employee (for selecting manager field)
        $employees = Employee::all();
        $employees = $employees->sortBy('name')->values()->all();
        return view('department.index', compact('departments', 'employees'));
    }

    // show list of employees in this department
    public function employeeList($id)
    {
        $dp = Department::find($id);
        $employees = Employee::where('department_id', '=', $id)->paginate(10);
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
            'dp-name.string' => 'The name field must be a string.',
            'dp-office-number.phone' => 'The office number field contains an invalid number.',
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'dp-name' => 'required|string',
            'dp-office-number' => 'required|phone:VN',
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
        // Get list of employee (for selecting manager field)
        $employees = Employee::all();
        $employees = $employees->sortBy('name')->values()->all();
        $manager_name = null;
        foreach ($employees as $index => $em) {
            if ($em->id == $dp->manager_id) {
                $manager_name = $em->name;
                $tmp = $employees[0];
                $employees[0] = $employees[$index];
                $employees[$index] = $tmp;
            }
        }

//        $employees = $dp->employees;
        return view('department.editDepartmentForm', compact('dp', 'employees', 'manager_name'));
    }
    
    // Edit a department information
    // Need to be enhanced with validation
    public function edit(Request $request)
    {
        
        // Customize validation messages
        $messages = [
            'dp-name.required' => 'The name field is required.',
            'dp-office-number.required' => 'The office number field is required.',
            'dp-name.string' => 'The name field must be a string.',
            'dp-office-number.phone' => 'The office number field contains an invalid number.',
            'dp-manager-id.integer' => 'You must select one manager.',
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'dp-name' => 'required|string',
            'dp-office-number' => 'required|phone:VN',
            'dp-manager-id' => 'required|integer',
        ], $messages);
        
        $dp_id = $request->input('dp-id');
        $new_dp_name = $request->input('dp-name');
        $new_dp_office_number = $request->input('dp-office-number');
        $new_dp_manager_id = $request->input('dp-manager-id');

        // Find the department with provided id
        $dp = Department::find($dp_id);

        // Get list of employee (for selecting manager field)
        $employees = Employee::all();
        $employees = $employees->sortBy('name')->values()->all();
//        $employees = $dp->employees;
        $manager_name = null;
        foreach ($employees as $index => $em) {
            if ($em->id == $dp->manager_id) {
                $manager_name = $em->name;
                $tmp = $employees[0];
                $employees[0] = $employees[$index];
                $employees[$index] = $tmp;
            }
        }

        // If the provided information from Edit form is not modified, do nothing
        if ($dp->name == $new_dp_name && $dp->office_number == $new_dp_office_number && $dp->manager_id == $new_dp_manager_id) {
            $result = 'Department information remains unchanged!';
            $alert_type = 'warning';
        }
        else {
            // Update to database
            $dp->name = $new_dp_name;
            $dp->office_number = $new_dp_office_number;
            $dp->manager_id = $new_dp_manager_id;
            $dp->save();
            $dp->manager_name = Employee::find($dp->manager_id)->name;

            // Create alert message to flash back to session
            $result = 'Department information updated!';
            $alert_type = 'success';
        }
        return json_encode(array(
            'result'=>$result, 
            'alert_type'=>$alert_type, 
            'dp'=>$dp, 
            'employees'=>$employees,
        ));
        return view('department.editDepartmentForm', compact('result', 'alert_type', 'dp', 'employees', 'manager_name'));
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
