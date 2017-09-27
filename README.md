![Platform Logo](https://s3.amazonaws.com/disastersystems/platform-logo.png)

# Disaster Recovery Platform

![TravisCI Status](https://travis-ci.org/disastersystems/disaster-recovery.svg?branch=master)
[![Slack Status](https://disastersystems.herokuapp.com/badge.svg)](http://slack.disastersystems.org/)

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

## Migrating Data
```
MUST create term "Shelters" under Resources vocabulary
docker-compose exec --user 82 php drush cr --root=/var/www/html/web
docker-compose exec --user 82 php drush import-organization --root=/var/www/html/web
```
## Update Configuration
**IMPORTANT:** Only need to do this to get latest updates.
```
bash update.sh
```

- If you have this error `Entities exist of type Shortcut link and Default. These entities need to be deleted before importing.`, replace uuid in `shortcut.set.default.yml` with null then try to re-import again. Here's a link to the [bug](https://www.drupal.org/node/2583113) report in the D8 issue queue.

### For developer only:
## Export Configuration

```
docker-compose exec --user 82 php drush config-export --root=/var/www/html/web
```

**IMPORTANT:** Only commit files related to your features only.

## Sponsors

[![Poetic Logo](https://s3.amazonaws.com/disastersystems/poetic-dark.svg)](https://poeticsystems.com)
