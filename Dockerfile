FROM php:7.3-apache

# Composer dependancies
RUN apt-get update -y
RUN apt-get install -y git zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel extensions
RUN docker-php-ext-install pdo pdo_mysql

# Apache configuration
COPY --chown=www-data:www-data vhost.conf /etc/apache2/sites-available/000-default.conf
COPY --chown=www-data:www-data ports.conf /etc/apache2/ports.conf

RUN ["/usr/sbin/a2enmod", "rewrite"]
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

CMD apache2-foreground