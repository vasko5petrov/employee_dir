# Employee Directory application
## Introduction
**What is this application?**
* A web application for human resource management.
* It's free for all of you. Open source, too. :)

**Releases**
* [1.1.0](https://github.com/trieudh58/employee_dir/releases/tag/1.1.0) (latest-stable)
* [1.0.0](https://github.com/trieudh58/employee_dir/releases/tag/1.0.0)

**Demo deployment**
* Step 1: Visit our [website](http://trieudh.me), or go directly to [login page](http://trieudh.me/login)
* Step 2: Login with admin account (example@gmail.com - 123456) then enjoy!

## Functionalities
**Administration**
* [Login](http://trieudh.me/login)
* [Update admin password](http://trieudh.me/update/password) - need login
* [Invite new admin](http://trieudh.me/invite) (only supper admin - example@gmail.com could use this) - need login

**Department management**
* [Show departments](http://trieudh.me/department)
* [Show department detail](http://trieudh.me/department/2/detail)
* [Show list of employees in a department](http://trieudh.me/department/2/employee)
* [Add new department](http://trieudh.me/department/add) - need login
* [Edit a department](http://trieudh.me/department/2/edit) - need login
* Delete a department - need login

**Employee management**
* [Show employees](http://trieudh.me/employee)
* [Show employee profile](http://trieudh.me/employee/1/detail)
* [Add new employee](http://trieudh.me/employee/add) - need login
* [Edit an employee](http://trieudh.me/employee/1/edit) - need login
* Delete an employee - need login
* Search employees (by name)

**Other notes**
* All form inputs have validation: email format, Vietnam phone number, image types (jpeg, png),...
* Department & Employee main pages have pagination (if over 10 rows).
* Responsive views.

## Installation (for developers)
* Step 1: Clone this repository:
```
git clone https://github.com/trieudh58/employee_dir.git
```
* Step 2: Rename `.env.example` to `.env`. Then, set up your local environment variables:
```
...
APP_URL=http://localhost
...
DB_DATABASE=<your_database_name>
DB_USERNAME=<your_mysql_username>
DB_PASSWORD=<your_mysql_password>
```
* Step 3: Update dependencies:
```
composer update
```
* Step 4: Generate a app_key, migrate database and seed some data into database:
```
php artisan generate:key
php artisan migrate
php artisan db:seed
```
* Step 5: Now, you can start your app with the following command:
```
php artisan serve
```
and visit `localhost:8000` to see the miracle. :)

## Contributors
* Đặng Hải Triều - [@trieudh58](https://github.com/trieudh58)
* Nguyễn Thế Tùng - [@tungnt-580](https://github.com/tungnt-580)
* Nguyễn Khắc Hiếu - [@hieunk58](https://github.com/hieunk58)
