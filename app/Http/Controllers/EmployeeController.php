<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Faker\Provider\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Validation\Validator;
use Symfony\Component\Console\Input\Input;

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
                'em-department-id' => 'required|integer',
                'image' => 'image'
            ];

            // Make validation
            $this->validate($request, $rules, $messages);

            $em_name = $request->input('em-name');
            $em_job_title = $request->input('em-job-title');
            $em_email = $request->input('em-email');
            $em_phone_number = $request->input('em-phone-number');
            $em_department_id = $request->input('em-department-id');

            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $img_name = $image->getClientOriginalName();
                    $em_profile_picture = time() . '.' . $img_name;
                    $image->move('uploads/images', $em_profile_picture);
            }
            else {
                    $em_profile_picture = 'uploads/images/icon-user-default.png';
            }

            // Insert new employee record into database
            $em = new Employee();
            $em->name = $em_name;
            $em->job_title = $em_job_title;
            $em->email = $em_email;
            $em->phone_number = $em_phone_number;
            $em->department_id = $em_department_id;
            $em->picture = 'uploads' . '/images/' . $em_profile_picture;
            $em->save();

            // Get list of department for next <option> form
            $departments = Department::all()->sortBy('name')->values()->all();

            // Create success flag
            $flag = true;

            return view('employee.addEmployeeForm', compact('departments', 'flag'));
    }

    //Show a employee details
    public function show($id) 
    {
        $em = Employee::find($id);
        $em->department_name = Department::find($em->department_id)->name;
        return view('employee.showEmployeeDetails', compact('em'));
    }
    
    // Return form: Edit a employee information
    public function editForm($id)
    {
        $em = Employee::find($id);
        $departments = Department::all();
        $departments = $departments->sortBy('name');
        return view('employee.editEmployeeForm', compact('em', 'departments'));
    }
    
    // Edit a employee information
    // Need to be enhanced with validation
    public function edit(Request $request)
    {
        // Customize validation messages
        $messages = [
            'em-name.required' => 'The name field is required.',
            'em-department-id.required' => 'The department field is required.',
            'em-job-title.required' => 'The job title field is required.',
            'em-name.string' => 'The name field must be a string.',
            'em-department-id.integer' => 'You must select one department.',
            'em-job-title.string' => 'The job title field must be a string.',
            'em-email.email' => 'You must enter a valid email adress'
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'em-name' => 'required|string',
            'em-department-id' => 'required|integer',
            'em-job-title' => 'required|string',
            'em-email' => 'email'
        ], $messages);
        
        $em_id = $request->input('em-id');
        $new_em_name = $request->input('em-name');
        $new_em_department_id = $request->input('em-department-id');
        $new_em_job_title = $request->input('em-job-title');
        $new_em_phone_number = $request->input('em-phone-number');
        $new_em_email = $request->input('em-email');

        // Find the employee with provided id
        $em = Employee::find($em_id);
        // and all departments
        $departments = Department::all();

        // If the provided information from Edit form is not modified, do nothing
        if ($em->name === $new_em_name && $em->department_id === $new_em_department_id && $em->job_title === $new_em_job_title && $em->phone_number === $new_em_phone_number && $em->email === $new_em_email) {
            $result = 'Employee information remains unchanged!';
            $alert_type = 'warning';
        }
        else {
            // Update to database
            $em->name = $new_em_name;
            $em->department_id = $new_em_department_id;
            $em->job_title = $new_em_job_title;
            $em->phone_number = $new_em_phone_number;
            $em->email = $new_em_email;
            $em->save();

            // Create alert message to flash back to session
            $result = 'Employee information successfully updated!';
            $alert_type = 'success';
        }
        return view('employee.editEmployeeForm', compact('result', 'alert_type', 'em', 'departments'));
    }
}
