<?php

namespace App\Http\Controllers;

use App\Department;
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

    // Return form: Add a new employee
    public function addForm()
    {
        $departments = Department::all()->sortBy('name')->values()->all();
        return view('employee.addEmployeeForm', compact('departments'));
    }

    // Add a new employee
    public function add(Request $request)
    {
        // Customize validation messages
        $messages = [
            'em-name.required' => 'The name field is required.',
            'em-job-title.required' => 'The job title field is required.',
            'em-email.email' => 'Please provide a valid email address.',
            'em-phone-number.string' => 'Please provide a valid phone number.',
            'em-department-id.required' => 'The department field is required.',
            'em-department-id.integer' => 'You must select one department.',
        ];

        // Validation rules
        $rules = [
            'em-name' => 'required|string',
            'em-job-title' => 'required|string',
            'em-email' => 'email',
            'em-phone-number' => 'string',
            'em-department-id' => 'required|integer'
        ];

        // Make validation
        $this->validate($request, $rules, $messages);
        
        $em_name = $request->input('em-name');
        $em_job_title = $request->input('em-job-title');
        $em_email = $request->input('em-email');
        $em_phone_number = $request->input('em-phone-number');
        $em_department_id = $request->input('em-department-id');

        // Insert new employee record into database
        $em = new Employee();
        $em->name = $em_name;
        $em->job_title = $em_job_title;
        $em->email = $em_email;
        $em->phone_number = $em_phone_number;
        $em->department_id = $em_department_id;
        $em->save();

        // Get list of department for next <option> form
        $departments = Department::all()->sortBy('name')->values()->all();

        // Create success flag
        $flag = true;

        return view('employee.addEmployeeForm', compact('departments', 'flag'));
    }
}
