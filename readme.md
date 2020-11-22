#Description
- Laravel 5.7
- simple CRUD app with 2 different fields
- Form Requests for validations
- send an email when the CRUD record is created or updated; using Queues
- a console command that sends an email every hour

# Run
- run `composer install`
- create new database `CREATE SCHEMA caag DEFAULT CHARACTER SET utf8 ;
- run `php artisan migrate`
- copy `.env.example` to `.env` file then edit this file: 
```
##Database  Connection 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=caag
DB_USERNAME=username
DB_PASSWORD=password
```
- run `php artisan queue:work --queue=high,default` to listen to the queue
- navigate to `'http://{yout_host}/home'`

# Commands 
- `php artisan send:hourly-email` this has been registerd to the kernel to send email each hourly.

# Testing
- run `./vendor/bin/phpunit`

