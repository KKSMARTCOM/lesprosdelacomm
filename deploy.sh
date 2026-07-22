#!/usr/bin/env bash
# exit on error
set -o errexit

echo "=== Installing Composer dependencies ==="
composer install --no-dev --optimize-autoloader --no-interaction

echo "=== Clearing caches ==="
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "=== Running database migrations ==="
php artisan migrate --force --no-interaction

echo "=== Seeding database (if needed) ==="
# php artisan db:seed --force --no-interaction

echo "=== Caching configuration ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Creating storage link ==="
php artisan storage:link || true

echo "=== Setting permissions ==="
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "=== Starting PHP-FPM and Nginx ==="
php-fpm -D
nginx -g "daemon off;"
