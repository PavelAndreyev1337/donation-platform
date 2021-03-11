# Donation Platform

Donation Platform is a simple application using Laravel.

## Installation
- copy code to server folder
- edit server configuration
- rename file `.env.example` to `.env`
- write credentionals into `.env`
- change debug option `APP_DEBUG` to `false` into `.env`
- autoloader optimization `composer install --optimize-autoloader --no-dev`
- optimizing configuration loading `php artisan config:cache`
- optimizing route loading `php artisan route:cache`
- optimizing view loading `php artisan view:cache`
- initialize database with CLI command `php artisan migrate`
- **optional** may insert into database default values for testing with command `php artisan db:seed --class=DonationSeeder` or run tests `php artisan test`
