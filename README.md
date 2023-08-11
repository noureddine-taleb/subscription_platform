## install the app

### a. install

```bash
git clone git@github.com:noureddine-taleb/subscription_platform.git
```

### b. install depandencies

```bash
composer install
```

### c. set .env

add the appropriate database and user/password to your .env file. add redis and email configurations. set `QUEUE_CONNECTION` to `database`.

## to run the app

### a. create database schema

```bash
php artisan migrate
```

### b. seed the database with test data

```bash
php artisan db:seed
```

### c. run the server

```bash
php artisan serve
```

### d. queue listerner

in a different terminal run:
```bash
php artisan queue:listen
```
this will run any job asynchronously.

## Optional

to send mails to users that already exists, but didn't yet receive an email notification run:

```bash
php artisan app:send-emails
```

Note that this only works for the first time it runs. because any other subsequent post created using restapi, will automatically send the email asynchronously.

## Api Doc

in the root folder you will find postman collection file "subscription.postman_collection.json" import it, and have fun !