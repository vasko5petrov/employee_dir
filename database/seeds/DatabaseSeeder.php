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
        $user->email = 'example@gmail.com';
        $user->username = 'Administrator';
        $user->password = bcrypt('123456');
        $user->save();

        // Using faker
        $faker = Faker::create();
        foreach (range(0, 15) as $index) {
            foreach (range(0, 5) as $count) {
                DB::table('employees')->insert([
                    'name' => $faker->name,
                    'job_title' => $faker->jobTitle,
                    'department_id' => $index + 1,
                    'email' => $faker->email,
                    'phone_number' => $faker->phoneNumber,
                    'picture' => 'uploads/images/icon-user-default.png'
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
