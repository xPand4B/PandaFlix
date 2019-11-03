#!/usr/bin/env bash
# DESCRIPTION: Compiles frontend changes on the go.

I: rm public/*.js
INCLUDE: ./../../common/actions/.install-npm.sh
INCLUDE: ./../../common/actions/.npm-run-watch.sh
