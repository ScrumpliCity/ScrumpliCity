FROM mcr.microsoft.com/devcontainers/php:1-8.2-bullseye

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions \
    pcntl \
    zip \
    pdo_mysql
