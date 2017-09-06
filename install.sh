#!/bin/bash
composer install
docker-compose up -d
docker-compose exec --user 82 php drush si disaster_recovery --config-dir=/var/www/html/config/sync  --db-url=mysql://drupal:drupal@mariadb/drupal  --root=/var/www/html/web -y
OUTPUT=$(docker-compose exec --user 82 php drush uli -l drupal.docker.localhost:8000  --root=/var/www/html/web)
echo ""
echo "Click here to login to site: ${OUTPUT}"