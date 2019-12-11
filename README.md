# eloquent-migrator

Simple db migrator that uses Laravel's db layer.

## Usage via docker-compose
* Run `make build start`
* Check the migrator logs with `docker logs -f eloquent_migrator`

## Usage via docker run
* Run `docker build . -t eloquent-migrator`
* Run `docker run --env-file docker.env eloquent-migrator`

## Usage without docker
* Modify config.php to replace $_ENV values with actual values
* Run `composer install`
* Run `php runMigrations.php`

## Adding new schemas
* Create a new class under src/Schemas that implements SchemaInterface
* See existing examples
* See eloquent documentation https://laravel.com/docs/5.7/migrations#creating-tables
* Add the new schema to the `SCHEMA_LIST` config in config.php

## Adding updates
* Create a new class under src/Updates that implements either AlterInterface (plain MySql alters) or UpdateInterface (supports blueprints)
* See existing examples
* See eloquent documentation https://laravel.com/docs/5.7/migrations#column-modifiers
* Add the new update to the `UPDATES_LIST` config in config.php

## Required environment variables (docker.env):
* MYSQL_HOST
* MYSQL_PORT
* MYSQL_DATABASE
* MYSQL_USER
* MYSQL_PASSWORD
* ENVIRONMENT - use `prod` as value for production environments
## Optional environment variables
* DB_CONNECT_MAX_RETRIES - after how many failed db connection should it shutdown, defaults to 10
* DB_CONNECT_RETRY_TIME - how much should the app wait until to attempt a reconnect, defaults to 10
