# syntax=docker/dockerfile:1.7-labs

FROM dunglas/frankenphp

# install php dependencies
RUN install-php-extensions \
    pcntl \
    zip \
    pdo_mysql

RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy composer files
COPY composer.* .

# install dependencies so they can be cached by docker
RUN composer install --no-dev --no-scripts

# copy source code
COPY . /app

# run scripts that depend on the source code that were previously not run
RUN composer install --optimize-autoloader --no-dev

# clear optimization and cache files
RUN php artisan optimize:clear

# cache everything except config
RUN php artisan event:cache
RUN php artisan route:cache
RUN php artisan view:cache

CMD ["./start.sh"]





# FROM php:8.2-fpm-alpine

# WORKDIR /app

# # Use the default production configuration # see https://hub.docker.com/_/php
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# COPY composer.* /app

# RUN composer install --optimize-autoloader --no-dev

# COPY . /app









# FROM dunglas/frankenphp
 
# RUN install-php-extensions \
#     pcntl
#     # Add other PHP extensions here...
 
# COPY . /app
 
# ENTRYPOINT ["php", "artisan", "octane:frankenphp"]