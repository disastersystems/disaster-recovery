#!/bin/bash
docker-compose exec --user 82 php drush mr resources --root=/var/www/html/web
docker-compose exec --user 82 php drush mr alert --root=/var/www/html/web
docker-compose exec --user 82 php drush mr help --root=/var/www/html/web
docker-compose exec --user 82 php drush mr update --root=/var/www/html/web