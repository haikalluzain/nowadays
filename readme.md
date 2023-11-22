<h1 align="center">
  Nowadays
  <br>
</h1>

## Install

### Development

#### Requirements

- Install Git
- Install PHP 7.3
- Install Composer
- Install MySQL database

### Get Started
- First, create a database with name nowadays, then use this command `cp .env.example .env` to create .env file and you can configure the database connection there.
- After that, follow this command:
####
    composer install
    php artisan key:generate
    php artisan migrate --seed
    php artisan passport:install

- Then, you can start the project that hosted at `http://localhost:8000` with command:
####
    php artisan serve

### Login Account

    email: haikal@gmail.com
    pass: 12345678

or you can create your own account by going to register page

