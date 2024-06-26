#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:clear
php artisan config:cache

echo "Caching routes..."
php artisan route:clear
php artisan route:cache

echo "Caching routes..."
php artisan view:clear
php artisan view:cache

echo "Running First Time migrations..."
php artisan migrate:fresh --seed --force
