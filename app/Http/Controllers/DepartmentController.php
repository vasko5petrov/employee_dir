<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        return view('department.index');
    }
}
