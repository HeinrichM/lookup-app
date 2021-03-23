## Lookup app installation


- Copy .env.example to .env
- Edit .env and add DB_DATABASE, DB_USERNAME, DB_PASSWORD details
- Open CMD in the root of the project and run the following
- Run `composer install`
- Run `npm install && npm run prod`
- Run `php artisan migrate --seed`
- Run `php artisan key:generate`
- Run `php artisan serv`
- Navigate to the url that is provided

## Requirements

- LAMP or WAMP environment
- Composer
- PHP >= 7.3

