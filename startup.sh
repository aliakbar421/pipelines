#!/bin/bash

# Install PHP dependencies (no dev packages)
composer install --no-dev --optimize-autoloader --no-interaction

# Build frontend assets
npm install
npm run build

# Set up SQLite database file if it doesn't exist
mkdir -p /home/site/wwwroot/database
touch /home/site/wwwroot/database/database.sqlite

# Set correct permissions on storage and cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Run database migrations
php artisan migrate --force

# Clear and cache config for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage symlink
php artisan storage:link
