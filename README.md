
## Installation 

Installation is pretty forward as of any other laravel application.

 Run ```composer install```.
  
 Copy your ```.env.example``` to ```.env``` set your database information.

After installing migrate and run database seeder to see records.

- ```php artisan migrate```
- ```php artisan db:seed```

An admin user will be created which you can uset too see all the records:
```
admin@test.com
password
```

## Run Tests
To run the the test run the command
```
.\vendor\bin\phpunit
```
