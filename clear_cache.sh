#!/bin/bash

php app/console cache:clear --env=prod
chmod 777 -R app/cache/
chmod 777 -R app/logs/

