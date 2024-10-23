# syntax=docker/dockerfile:1.7-labs

FROM dunglas/frankenphp

# install php dependencies
RUN install-php-extensions \
    pcntl \
    zip \
    pdo_mysql

RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

# install composer
COPY --link --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy composer files
COPY --link composer.* .

# install dependencies so they can be cached by docker (but don't
# execute scripts as those require artisan)
RUN composer install --no-dev --no-scripts --no-autoloader && rm -rf /root/.cache /data/composer /config/composer

# copy source code
COPY --link --exclude=composer.* . /app

# run scripts that depend on the source code that were previously not run
RUN composer install --optimize-autoloader --no-dev && rm -rf /root/.cache /data/composer /config/composer

# cache everything except config (config is cached on startup in start.sh)
RUN php artisan event:cache
RUN php artisan route:cache
RUN php artisan view:cache

HEALTHCHECK CMD [ "curl", "-f", "http://localhost:80/up" ]

CMD ["./start.sh"]
