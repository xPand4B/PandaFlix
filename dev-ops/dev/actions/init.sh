#!/usr/bin/env bash
# DESCRIPTION: Initializes everything.

INCLUDE: ./../../common/actions/.init.sh

php artisan migrate:fresh
php artisan db:seed


