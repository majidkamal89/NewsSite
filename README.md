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

	
Directory Permission
=========================
	- Allow read/write permission to public/uploads/* directory.
  - For any query contact me majidkamal89@gmail.com