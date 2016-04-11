<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;

use Illuminate\Http\Request;

use App\Http\Requests;

class DepartmentController extends Controller
{
    // Put department's routes under Auth middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show list of departments
    public function index()
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }
}
