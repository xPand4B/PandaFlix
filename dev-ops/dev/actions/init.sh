#!/usr/bin/env bash
# DESCRIPTION: Initializes everything.

INCLUDE: ./../../common/actions/.init-dev.sh

php artisan migrate:fresh
php artisan passport:install
php artisan db:seed
