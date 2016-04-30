# Employee Directory application
## Introduction
**What is this application?**
* A web application for human resource management.
* It's free for all of you. Open source, too. :)

**Releases**
* [1.1.0](https://github.com/trieudh58/employee_dir/releases/tag/1.1.0) (latest-master-stable)
* [1.0.0](https://github.com/trieudh58/employee_dir/releases/tag/1.0.0)

**Demo deployment**
* Step 1: Visit our [website](http://trieudh.me) and take a look on the guide, or go directly to [login page](http://trieudh.me/login)
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

## Installation (for developers) - updating
* Step 1: Clone this repository:
```
git clone https://github.com/trieudh58/employee_dir.git
```
* Step 2: Rename `.env.example` (from root directory) to `.env`. Then, set up your local environment variables:
```
...
APP_URL=http://localhost
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your_database_name>
DB_USERNAME=<your_mysql_username>
DB_PASSWORD=<your_mysql_password>
```
* Step 3: From Terminal of this project root directory, run:
```
composer update
```
* Step 4: Generate a app_key, migrate database, seed data into database:
```
php artisan generate:key
php artisan migrate
php artisan db:seed
```
* Step 5: Now, you can start your app with the following command:
```
php artisan serve
```
and visit `localhost:8000` to see the miracle :)

## Contributors
* [@trieudh58](https://github.com/trieudh58)
* [@tungnt-580](https://github.com/tungnt-580)
* [@hieunk58](https://github.com/hieunk58)
