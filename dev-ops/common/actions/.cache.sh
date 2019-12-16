#!/usr/bin/env bash

I: rm bootstrap/cache/*.php
I: rm storage/debugbar/*.json
I: php artisan optimize:clear
