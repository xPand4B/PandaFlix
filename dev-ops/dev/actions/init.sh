#!/usr/bin/env bash
# DESCRIPTION: Initializes everything.

INCLUDE: ./../../common/actions/.init.sh

php artisan db:seed

npm run dev --quiet --no-progress
