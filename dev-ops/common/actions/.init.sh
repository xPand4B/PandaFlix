#!/usr/bin/env bash

php artisan key:generate
php artisan migrate:fresh
php artisan storage:link
