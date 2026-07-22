#!/usr/bin/env bash
# exit on error
set -o errexit

# 1. On applique d'abord les migrations pour créer TOUTES les tables nécessaires
echo "=== Running database migrations ==="
php artisan migrate --force --no-interaction

# 2. ON FORCE LE PEUPLEMENT DE LA BASE (Seeding) AUTOMATIQUEMENT
echo "=== Seeding database ==="
php artisan db:seed --force --no-interaction

# 3. Maintenant on peut vider et reconstruire les caches sans risque
echo "=== Clearing caches ==="
php artisan cache:clear || true
php artisan config:clear
php artisan route:clear
php artisan view:clear

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
