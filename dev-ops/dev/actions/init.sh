#!/usr/bin/env bash
# DESCRIPTION: Initializes everything.

INCLUDE: ./../../common/actions/.clear.sh
INCLUDE: ./../../common/actions/.install-composer.sh
INCLUDE: ./../../common/actions/.install-npm.sh
INCLUDE: ./../../common/actions/.cache.sh
INCLUDE: ./../../common/actions/.init.sh

php artisan db:seed
npm run dev
