#!/usr/bin/env bash

INCLUDE: ./.clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-prod.sh
INCLUDE: ./.cache.sh

I: touch app/Components/Common/Database/database.sqlite

php artisan key:generate
php artisan storage:link
php artisan migrate:fresh
php artisan passport:install
