# syntax=docker/dockerfile:1.7-labs

FROM dunglas/frankenphp@sha256:661bbd11ce8b9bbf51ba6e13d1cb7ea533466984142d936411df325922c4cdb1

# install php dependencies
RUN install-php-extensions \
    pcntl \
    zip \
    pdo_mysql

RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

# set env vars for composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HTACCESS_PROTECT=0

# install composer
COPY --link --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy composer files
COPY --link composer.* .

# install dependencies so they can be cached by docker (but don't
# execute scripts as those require artisan)
RUN --mount=type=cache,target=/root/.cache \
    composer install --no-dev --no-scripts --no-autoloader

# copy source code
COPY --link --exclude=composer.* . /app

# allow execution of the start script
RUN chmod u+x /app/start.sh

# run scripts that depend on the source code that were previously not run
RUN composer install --optimize-autoloader --no-dev

# cache everything except config (config is cached on startup in start.sh)
RUN php artisan event:cache
RUN php artisan route:cache
RUN php artisan view:cache

HEALTHCHECK CMD [ "curl", "-f", "http://localhost:80/up" ]

CMD ["./start.sh"]
