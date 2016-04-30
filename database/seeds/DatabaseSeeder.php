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
        $employee->phone_number = '01664433265';
        $employee->department_id = '2';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Hieu-PX';
        $employee->job_title = 'Manager';
        $employee->department_id = '1';
        $employee->email = 'pxhieu@gmail.com';
        $employee->phone_number = '0967162578';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 1';
        $employee->job_title = 'Assistant';
        $employee->department_id = '1';
        $employee->email = 'example_employee_1@gmail.com';
        $employee->phone_number = '0967162537';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 2';
        $employee->job_title = 'Assistant';
        $employee->department_id = '1';
        $employee->email = 'example_employee_2@gmail.com';
        $employee->phone_number = '0967162537';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 3';
        $employee->job_title = 'Assistant';
        $employee->department_id = '1';
        $employee->email = 'example_employee_3@gmail.com';
        $employee->phone_number = '0967162537';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 4';
        $employee->job_title = 'Assistant';
        $employee->department_id = '2';
        $employee->email = 'example_employee_4@gmail.com';
        $employee->phone_number = '0988888888';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 5';
        $employee->job_title = 'Assistant';
        $employee->department_id = '2';
        $employee->email = 'example_employee_5@gmail.com';
        $employee->phone_number = '0988888888';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 6';
        $employee->job_title = 'Assistant';
        $employee->department_id = '2';
        $employee->email = 'example_employee_6@gmail.com';
        $employee->phone_number = '0988888888';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 7';
        $employee->job_title = 'Assistant';
        $employee->department_id = '2';
        $employee->email = 'example_employee_7@gmail.com';
        $employee->phone_number = '0988888888';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 8';
        $employee->job_title = 'Assistant';
        $employee->department_id = '2';
        $employee->email = 'example_employee_8@gmail.com';
        $employee->phone_number = '0988888888';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        $employee = new App\Employee();
        $employee->name = 'Example Employee 9';
        $employee->job_title = 'Assistant';
        $employee->department_id = '2';
        $employee->email = 'example_employee_9@gmail.com';
        $employee->phone_number = '0988888888';
        $employee->picture = 'uploads/images/icon-user-default.png';
        $employee->save();

        for ($i =0; $i < 20; $i++) {
            $deparment = new App\Department();
            $deparment->name = 'Example Department '.strval($i + 1);
            $deparment->office_number = '0978561225';
            $deparment->manager_id = $i + 1;
            $deparment->save();
        }
    }
}
