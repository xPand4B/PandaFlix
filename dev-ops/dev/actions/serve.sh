#!/usr/bin/env bash
# DESCRIPTION: Start a live server.

INCLUDE: ./frontend-build.sh
INCLUDE: ./../../common/actions/.cache.sh

php artisan serve
