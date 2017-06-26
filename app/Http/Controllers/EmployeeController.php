<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Faker\Provider\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Response;
use Datetime;

class EmployeeController extends Controller
{
    // show list of employees
    public function index(Request $request)
    {
        $search = $request->get('search');
        $em_search_name = $request->get('em-search-name');
        $em_search_dp = $request->get('em-search-dp');
        $query = Employee::where('name', 'like', '%' . $em_search_name . '%');
        if ($em_search_dp != '') {
            $query = $query->where('department_id', '=', $em_search_dp);
        }
        $employees = $query->orderBy('name')->paginate(15)->appends([
            'search' => $search, 
            'em-search-name' => $em_search_name,
            'em-search-dp' => $em_search_dp
        ]);
        $departments = Department::all();
        return view('employee.index', compact('employees', 'departments', 'em_search_name', 'em_search_dp', 'search'));
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
            // Testing date field           


            // Customize validation messages
            $messages = [
                'em-name.required' => 'The name field is required.',
                'em-gender.required' => 'The gender field is required.',
                'em-job-title.required' => 'The job title field is required.',
                'em-email.email' => 'Please provide a valid email address.',
                'em-email.unique' => 'This email address already exist.',
                'em-phone-number.phone' => 'The phone number field contains an invalid number.',
            ];

            // Validation rules
            $rules = [
                'em-name' => 'required|string',
                'em-gender' => 'required|string',
                'em-birthday' => 'string',
                'em-hiringDate' => 'string',
                'em-location' => 'string',
                'em-job-title' => 'required|string',
                'em-email' => 'email|unique:employees,email',
                'em-phone-number' => 'integer',
                'image' => 'image|max:2048'
            ];

            // Make validation
            $this->validate($request, $rules, $messages);

            $em_name = $request->input('em-name');
            $em_gender = $request->input('em-gender');
            $em_birthday = $request->input('em-birthday');
            $em_hiringDate = $request->input('em-hiringDate');
            $em_location = $request->input('em-location');
            $em_job_title = $request->input('em-job-title');
            $em_email = $request->input('em-email');
            $em_phone_number = $request->input('em-phone-number');
            $em_department_id = $request->input('em-department-id');
            if (!is_numeric($em_department_id)) {
                $em_department_id = null;
            }
            if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $img_name = $image->getClientOriginalName();
                    $em_profile_picture = time() . '.' . $img_name;
                    $image->move('uploads/images', $em_profile_picture);
            }
            else {
                    $em_profile_picture = 'icon-user-default.png';
            }

            // Insert new employee record into database
            $em = new Employee();
            $em->name = $em_name;
            $em->gender = $em_gender;
            $em->birthday = $em_birthday;
            $em->hiring_day = $em_hiringDate;
            $em->location = $em_location;
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
        $em_department_id = $em->department_id;
        $dp = Department::find($em_department_id);
        
        $em_birthday = EmployeeController::CheckDateForUndefined($em->birthday);
        $em_hiringDate = EmployeeController::CheckDateForUndefined($em->hiring_day);
        return view('employee.showEmployeeDetails', compact('em', 'dp', 'em_birthday', 'em_hiringDate'));
    }

    public function CheckDateForUndefined($date) {
        if($date != '0000-00-00') {
            return EmployeeController::formatDateToView($date);
        } else {
            $date = "";
        }
    }

    public function formatDateToView($date) {
        $dateFormat = new DateTime($date); 
        return date_format($dateFormat, 'd F Y');
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
    public function edit(Request $request)
    {
        // Customize validation messages
        $messages = [
            'em-name.required' => 'The name field is required.',
            'em-gender.required' => 'The gender field is required.',
            'em-job-title.required' => 'The job title field is required.',
            'em-email.email' => 'Please provide a valid email address.',
            'em-phone-number.phone' => 'The phone number field contains an invalid number.',
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'em-name' => 'required|string',
            'em-gender' => 'required|string',
            'em-location' => 'string',
            'em-birthday' => 'string',
            'em-hiringDate' => 'string',
            'em-job-title' => 'required|string',
            'em-email' => 'email',
            'em-phone-number' => 'integer',
            'image' => 'image|max:2048'
        ], $messages);
        
        $em_id = $request->input('em-id');
        $new_em_name = $request->input('em-name');
        $new_em_gender = $request->input('em-gender');
        $new_em_birthday = $request->input('em-birthday');
        $new_em_hiringDate = $request->input('em-hiringDate');
        $new_em_location = $request->input('em-location');
        $new_em_department_id = $request->input('em-department-id');
        $new_em_job_title = $request->input('em-job-title');
        $new_em_phone_number = $request->input('em-phone-number');
        $new_em_email = $request->input('em-email');
        if (!is_numeric($new_em_department_id)) {
            $new_em_department_id = null;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $upload_name = time() . '.' . $img_name;
            $new_em_picture = 'uploads/images/' . $upload_name;
            $image->move('uploads/images', $upload_name);
        }

        // Find the employee with provided id
        $em = Employee::find($em_id);
        // and all departments
        $departments = Department::all();

        // If the provided information from Edit form is not modified, do nothing
        if (!isset($new_em_picture) && $em->name === $new_em_name && $em->gender === $new_em_gender && $em->birthday === $new_em_birthday && $em->hiring_day === $new_em_hiringDate && $em->location === $new_em_location && $em->department_id === $new_em_department_id && $em->job_title === $new_em_job_title && $em->phone_number === $new_em_phone_number && $em->email === $new_em_email) {
            $result = 'Employee information remains unchanged!';
            $alert_type = 'warning';
        }
        else {
            // Update to database
            $em->name = $new_em_name;
            $em->gender = $new_em_gender;
            $em->birthday = $new_em_birthday;
            $em->hiring_day = $new_em_hiringDate;
            $em->location = $new_em_location;
            $em->department_id = $new_em_department_id;
            $em->job_title = $new_em_job_title;
            $em->phone_number = $new_em_phone_number;
            $em->email = $new_em_email;
            if (isset($new_em_picture)) $em->picture = $new_em_picture;
            $em->save();

            // Create alert message to flash back to session
            $result = 'Employee information successfully updated!';
            $alert_type = 'success';
        }
        return view('employee.editEmployeeForm', compact('result', 'alert_type', 'em', 'departments'));
    }

    // Delete an employee
    public function delete(Request $request)
    {
        $delete_id = $request->input('em-id');
        if (is_numeric($delete_id)) {
            try {
                // Update manager_id to null where this employee is a manager
                $dp = Department::where('manager_id', $delete_id)->first();
                if ($dp) {
                    $dp->manager_id = null;
                    $dp->save();
                }
                // Find employee and delete
                $em = Employee::find($delete_id);
                if ($em->picture != 'uploads/images/icon-user-default.png') {
                    unlink($em->picture);
                }
                $em->delete();
            }
            catch (\PDOException $exception) {
                return Response::make('Error! '.$exception->getCode());
            }
        }
        return redirect('/employee');
    }
}
