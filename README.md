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


## Optional

to send mails to users that already exists, but didn't yet receive an email notification run:

```bash
php artisan app:send-emails
```

Note that this only works for the first time it runs. because any other subsequent post created using restapi, will automatically send the email asynchronously.