#!/usr/bin/env bash

INCLUDE: ./.clear.sh
INCLUDE: ./.install-composer.sh
INCLUDE: ./.install-npm.sh
INCLUDE: ./.npm-run-prod.sh
INCLUDE: ./.cache.sh

php artisan key:generate
php artisan storage:link
