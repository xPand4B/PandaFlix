#!/usr/bin/env bash

I: touch app/Components/Common/Database/database.sqlite

INCLUDE: ./.clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-prod.sh
INCLUDE: ./.cache.sh

php artisan key:generate
php artisan storage:link
php artisan migrate:fresh
php artisan passport:install
