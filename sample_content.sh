#!/bin/bash
docker-compose exec --user 82 php drush mi resources --root=/var/www/html/web
docker-compose exec --user 82 php drush mi alert --root=/var/www/html/web
docker-compose exec --user 82 php drush mi help --root=/var/www/html/web
docker-compose exec --user 82 php drush mi update --root=/var/www/html/web