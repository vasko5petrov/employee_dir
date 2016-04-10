<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function manager()
    {
        return $this->hasMany('App\Employee');
    }
}
