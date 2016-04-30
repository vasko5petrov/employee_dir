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

        for ($i = 0; $i < 40; $i++) {
            $employee = new App\Employee();
            $employee->name = 'Example Employee '.strval($i + 1);
            $employee->job_title = 'Assistant';
            $employee->department_id = $i + 1;
            $employee->email = 'example_employee'.strval($i + 1).'@gmail.com';
            $employee->phone_number = '0967162537';
            $employee->picture = 'uploads/images/icon-user-default.png';
            $employee->save();
        }

        for ($i =0; $i < 40; $i++) {
            $deparment = new App\Department();
            $deparment->name = 'Example Department '.strval($i + 1);
            $deparment->office_number = '0978561225';
            $deparment->manager_id = $i + 1;
            $deparment->save();
        }
    }
}
