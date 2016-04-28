<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // php artisan db:seed to run
        App\User::truncate();
        App\Employee::truncate();
        App\Department::truncate();
        
        $user = new App\User();
        $user->email = 'example@gmail.com';
        $user->username = 'Admin';
        $user->password = bcrypt('123456');
        $user->save();
        
        $employee = new App\Employee();
        $employee->name = 'Adam';
        $employee->job_title = 'Developer';
        $employee->department_id = '1';
        $employee->email = 'adam@gmail.com';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Adam M';
        $employee->job_title = 'Manager';
        $employee->email = 'adam_M@gmail.com';
        $employee->phone_number = '0166443325';
        $employee->department_id = '2';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Hieu-PX';
        $employee->job_title = 'Manager';
        $employee->department_id = '1';
        $employee->email = 'pxhieu@gmail.com';
        $employee->phone_number = '09671625378';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $deparment = new App\Department();
        $deparment->name = 'KTLab, UET-VNU';
        $deparment->office_number = '0166334225';
        $deparment->manager_id = '3';
        $deparment->save();

        $deparment = new App\Department();
        $deparment->name = 'Bla bla bla';
        $deparment->office_number = '0432254566';
        $deparment->manager_id = '2';
        $deparment->save();

        $deparment = new App\Department();
        $deparment->name = 'Example Department';
        $deparment->office_number = '097856125625';
        $deparment->manager_id = '1';
        $deparment->save();
    }
}
