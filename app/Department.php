<?php

namespace App;

use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    // Find the Manager of the Department
    public function manager()
    {
        $employees = $this->employees;
        foreach ($employees as $em) {
            if ($em->is_manager == 1) return $em;
        }
        return false;
    }
}
