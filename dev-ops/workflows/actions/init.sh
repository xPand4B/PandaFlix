#!/usr/bin/env bash
# DESCRIPTION: Initialize the workflow.

I: rm app/Components/Common/Database/database.sqlite
I: touch app/Components/Common/Database/database.sqlite

INCLUDE: ./../../common/actions/.clear.sh
INCLUDE: ./../../common/actions/.install-composer.sh
INCLUDE: ./../../common/actions/.install-npm.sh
INCLUDE: ./../../common/actions/.cache.sh

php artisan key:generate

npm run dev
