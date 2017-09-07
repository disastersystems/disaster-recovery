![Platform Logo](https://s3.amazonaws.com/disastersystems/platform-logo.png)

# Disaster Recovery Platform

## Requirements
- [Docker Community Edition for Mac](https://store.docker.com/editions/community/docker-ce-desktop-mac) - Ensure Docker is installed and running
- [Composer](https://getcomposer.org/) - Ensure composer is installed

## Installation

Clone the repository
```
git clone https://github.com/disastersystems/disaster-recovery.git
cd disaster-recovery
bash install.sh
```

This will install the site, import existing configuration and generate one time login link for you.

## Export Configuration

```
docker-compose exec --user 82 php drush config-export --root=/var/www/html/web
```

**IMPORTANT:** Only commit files related to your features only.

## Synchronize Configuration

```
git pull
docker-compose exec --user 82 php drush config-import --root=/var/www/html/web
```

- If you have this error `Entities exist of type Shortcut link and Default. These entities need to be deleted before importing.`, replace uuid in `shortcut.set.default.yml` with null then try to re-import again. Here's a link to the [bug](https://www.drupal.org/node/2583113) report in the D8 issue queue.

## Migrating Data
```
create term "Shelters" under Resources vocabulary
docker-compose exec --user 82 php drush cr --root=/var/www/html/web
docker-compose exec --user 82 php drush import-organization --root=/var/www/html/web
```

## Sponsors

[![Poetic Logo](https://s3.amazonaws.com/disastersystems/poetic-logo-med.png)](https://poeticsystems.com)
