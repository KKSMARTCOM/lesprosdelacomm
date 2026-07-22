#!/usr/bin/env bash
# exit on error
set -o errexit

echo "=== Installing Composer dependencies ==="
composer install --no-dev --working-dir=$DOCUMENT_ROOT --optimize-autoloader --no-interaction

echo "=== Clearing caches ==="
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "=== Running database migrations ==="
php artisan migrate --force --no-interaction

echo "=== Seeding database (if needed) ==="
# Uncomment the next line if you want to seed the database on deployment
# php artisan db:seed --force --no-interaction

echo "=== Caching configuration ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Creating storage link ==="
php artisan storage:link || true

echo "=== Setting permissions ==="
chmod -R 775 storage bootstrap/cache

echo "=== Build completed successfully ==="
