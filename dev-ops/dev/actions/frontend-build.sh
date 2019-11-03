#!/usr/bin/env bash
# DESCRIPTION: Build the frontend.

I: rm public/*.js
INCLUDE: ./../../common/actions/.install-npm.sh
INCLUDE: ./../../common/actions/.npm-run-dev.sh
