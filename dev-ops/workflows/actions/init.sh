#!/usr/bin/env bash
# DESCRIPTION: Initialize the workflow.

I: rm app/Components/Common/Database/database.sqlite
I: touch app/Components/Common/Database/database.sqlite

INCLUDE: ./../../common/actions/.init.sh

npm run prod --quiet --no-progress
