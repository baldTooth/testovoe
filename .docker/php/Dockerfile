FROM php:8.3-fpm



RUN apt-get update -y \
    &&  apt-get install -y curl \
    &&  apt-get install -y libpq-dev libzip-dev\
    && docker-php-ext-install  zip  pdo_pgsql pgsql \
    && apt-get install vim -y 
    
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer


COPY ./app /var/www/app

WORKDIR /var/www/app


ENV PATH $PATH:/root/.composer/vendor/bin

RUN composer install
RUN composer dump-autoload

EXPOSE 9000

CMD ["php-fpm"]
