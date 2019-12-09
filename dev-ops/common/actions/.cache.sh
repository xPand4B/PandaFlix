#!/usr/bin/env bash

I: php artisan clear-compiled
I: php artisan cache:clear
I: php artisan config:cache
I: php artisan optimize:clear
I: php artisan route:clear
I: php artisan view:clear
