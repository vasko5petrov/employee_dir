<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        $user->email = 'admin@anakatech.com';
        $user->username = 'Admin';
        $user->password = bcrypt('123456');
        $user->save();

        //Random Date
        $rDateB = date("Y-m-d",mt_rand(301055681,901055681));
        $rDateH = date("Y-m-d",mt_rand(1001055681,1101055681));

        // Using faker
        $faker = Faker::create();
        foreach (range(0, 10) as $index) {
            foreach (range(0, 3) as $count) {
                DB::table('employees')->insert([
                    'name' => $faker->name,
                    'job_title' => $faker->jobTitle,
                    'department_id' => $index + 1,
                    'email' => $faker->email,
                    'phone_number' => $faker->phoneNumber,
                    'picture' => 'uploads/images/icon-user-default.png',
                    'gender' => 'Male',
                    'location' => 'Sofia, Bulgaria',
                    'birthday' => date("Y-m-d",mt_rand(301055681,901055681)),
                    'hiring_day' => date("Y-m-d",mt_rand(1001055681,1101055681)),
                ]);
            }
        }
        foreach (range(0, 40) as $index) {
            DB::table('departments')->insert([
                'name' => $faker->company,
                'office_number' => $faker->tollFreePhoneNumber,
                'manager_id' => $index + 1
            ]);
        }
    }
}
