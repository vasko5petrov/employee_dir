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
        App\Post::truncate();
        App\PostCategory::truncate();

        $user = new App\User();
        $user->email = 'example@gmail.com';
        $user->username = 'Admin';
        $user->password = bcrypt('123456');
        $user->save();

        //Random Date
        $rDateB = date("Y-m-d",mt_rand(301055681,901055681));
        $rDateH = date("Y-m-d",mt_rand(1001055681,1101055681));

        // Using faker
        $faker = Faker::create();
        foreach (range(0, 4) as $cat_index) {
            foreach (range(0, 4) as $index) {
                DB::table('posts')->insert([
                    'title' => $faker->text(20),
                    'body' => $faker->text(5000),
                    'cover_image' => 'uploads/posts/cover-image-default.jpg',
                    'post_category_id' => $cat_index + 1,
                ]);
            }
        }  

        foreach (range(0, 4) as $index) {
            DB::table('posts_categories')->insert([
                'name' => 'Category '.($index+1),
                'importance' => $index
            ]);
        }

        foreach (range(0, 4) as $index) {
            foreach (range(0, 8) as $count) {
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
                    'hiring_day' => date("Y-m-d",mt_rand(1001055681,1498611681)),
                ]);
            }
        }
        foreach (range(0, 4) as $index) {
            DB::table('departments')->insert([
                'name' => $faker->company,
                'office_number' => $faker->tollFreePhoneNumber,
                'manager_id' => $index + 1
            ]);
        }
    }
}
