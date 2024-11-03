#!/bin/sh
set -e

composer install

if [ "$1" = "php-fpm" ]; then
    echo "Running migrations..."
    php artisan migrate --force || { echo "Migrations failed"; exit 1; }
    echo "Seeding database..."
    php artisan db:seed --class=Database\\Seeders\\ProductsTableSeeder || { echo "Seeding failed"; exit 1; }
fi

exec "$@"
