FROM alexcicioc/php:7.4-cli-composer-mysql

COPY ./composer.* /app/

WORKDIR /app

RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader

COPY ./ /app

RUN composer dump-autoload --no-scripts --no-dev --optimize

CMD ["php", "runMigrations.php"]
