#!/bin/bash
php artisan migrate --force # migrate db
php artisan config:cache # cache config from env files
php artisan octane:frankenphp --port=80 # host on port 80