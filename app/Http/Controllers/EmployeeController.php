<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeeController extends Controller
{
    // Put employee's routes under Auth middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show list of employees
    public function index()
    {
        return view('employee.index');
    }
}
