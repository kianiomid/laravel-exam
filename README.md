## 1.Requirements
- PHP >= 7.3
- Mysql >= 12.0

## 2.Installation
- run $`git clone https://github.com/kianiomid/laravel-exam.git`
- run $`cd laravel-exam`
- run $`composer install`

## 3.Setup your enviroment variables in .env
- run $`cp .env-sample .env`
- edit the `.env` file and set the required database connection data

## 4.Migration/Seed The Database
### Migrate phase 🙂
- `php artisan migrate`


### Seed phase
- `php artisan db:seed`

## 5.Generate App key
- run $`php artisan key:generate`

## Module Installed 
* JWT
* Swagger
* Kavenegar