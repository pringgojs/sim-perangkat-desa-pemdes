## Deployment

Persyaratan:

-   php 8.2
-   git
-   composer

Deploy ECMP admin:

-   `git clone https://github.com/elitery/ecmp-admin`
-   cd ecmp-admin
-   `composer install`
-   copy `.env.example` ke `.env`
-   `php artisan key:gen`
-   `php artisan migrate:fresh --seed`
-   ubah `URL_ECMP_CUSTOMER` di `.env` ke endpoint ecmp-customer
-   ubah `X_API_KEY_ECMP_CUSTOMER` di `.env` sesuai dengan yg ada didatabase ecmp-customer

Deploy ECMP customer:

-   git fetch --all
-   git checkout dev-1.0.1
