![Platform Logo](https://s3.amazonaws.com/disastersystems/platform-logo.png)

# Disaster Recovery Platform

## Requirements
- [Docker4Drupal](https://github.com/wodby/docker4drupal/). Please follow documentation for usage. There will be a section below to summary some main points.
- [Composer Template for Drupal Projects](https://github.com/drupal-composer/drupal-project)
- [Docker Community Edition(Edge) for Mac](https://store.docker.com/editions/community/docker-ce-desktop-mac)

## Installation

```
- git clone https://github.com/disastersystems/disaster-recovery.git
- composer install
- docker-compose up -d
- open http://drupal.docker.localhost:8000
- run through installation process
- use "drupal" for username/password/dbname
- use "mariadb" for db host and leave port empty
```

## Synchronize Configuration
```
  - cat config/sync/system.site.yml to get uuid.
  - docker-compose exec --user 82 php drush cset "system.site" uuid "uuid-from-system-site-yml" --root=/var/www/html/web
  - docker-compose exec --user 82 php drush config-import --root=/var/www/html/web
```

- If you have this error `Entities exist of type Shortcut link and Default. These entities need to be deleted before importing.`, replace uuid in `shortcut.set.default.yml` with null then try to re-import again. Here's a link to the [bug](https://www.drupal.org/node/2583113) report in the D8 issue queue.

## Migrating Data
```
  - docker-compose exec --user 82 php drush import-organization --root=/var/www/html/web
```

## Sponsors

[![Poetic Logo](https://s3.amazonaws.com/disastersystems/poetic-logo-med.png)](https://poeticsystems.com)
