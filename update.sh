#!/bin/bash
git pull origin master
composer install
docker-compose exec --user 82 php drush config-import --root=/var/www/html/web