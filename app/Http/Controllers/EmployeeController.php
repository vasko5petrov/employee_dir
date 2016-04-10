<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        return view('employee.index');
    }
}
