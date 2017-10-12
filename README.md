# Laravel and AngularJs

Project Setup
==============

 - Install composer: https://getcomposer.org/doc/00-intro.md

 - Create a MySQL database for the project.

 - Create a file called .env:
```
	'DB_HOST' = 'HOST'
    'DB_DATABASE' = 'DATABASE',
    'DB_USERNAME' = 'USERNAME',
    'DB_PASSWORD' = 'PASSWORD',
    'NOTIFICATION_EMAIL' = 'emailaddress'
```
Replace with your connection info.

 - From the project directory,
   1. `composer install`

      That will download dependencies.

   2. `php artisan key:generate`

      That will Publish vendor dependencies.

   3. `php artisan migrate`

      That will apply database migrations


   5. `php artisan serve`

      That will start the dev server (not for production)


Every time you Clone , you should run those 6 commands.

Note:---
Here is some guidelines about running unit test.
Please follow my provided command.

1- To test all routes use command (included post routes too)
 - php vendor/phpunit/phpunit/phpunit --filter testAllRoutes

2- To test User Registeration route
 - php vendor/phpunit/phpunit/phpunit --filter testUserRegisterRoute

3- To test new user creation method
 - php vendor/phpunit/phpunit/phpunit --filter testCreateNewUser

4- To test user Login method
 - php vendor/phpunit/phpunit/phpunit --filter testUserLogin

5- To test create User News method
 - php vendor/phpunit/phpunit/phpunit --filter testCreateUserNews

6- To test All news listing method
 - php vendor/phpunit/phpunit/phpunit --filter testListAllNews

7- To test Latest 10 news with Author
 - php vendor/phpunit/phpunit/phpunit --filter testLatestNewsWithAuthor

8- To test all news of a User
 - php vendor/phpunit/phpunit/phpunit --filter testGetNewsByUserId

9- To test News detail method
 - php vendor/phpunit/phpunit/phpunit --filter testGetNewsById

10- To test All users and their news
  - php vendor/phpunit/phpunit/phpunit --filter testAllUserNews

11- To Create News for all users
  - php vendor/phpunit/phpunit/phpunit --filter testCreateAllUserNews

12- To Delete single user
  - php vendor/phpunit/phpunit/phpunit --filter testDeleteSingleUser

13- To Delete All Users
  - php vendor/phpunit/phpunit/phpunit --filter testDeleteAllUser


All above test methods would return you values in command prompt window to verify records. Point (1) is about testing all routes of application.

	
Directory Permission
=========================
	- Allow read/write permission to public/uploads/* directory.
  - For any query contact me majidkamal89@gmail.com