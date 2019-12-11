# eloquent-migrator

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
