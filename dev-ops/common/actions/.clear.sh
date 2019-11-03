#!/usr/bin/env bash

I: rm bootstrap/cache/*.php

I: rm -rf vendor

I: rm -rf node_modules

I: rm -rf public/storage
I: rm public/*.js
I: rm public/mix-manifest.json

I: rm storage/logs/*.log
