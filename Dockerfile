FROM php:8.1-fpm

ENV ACCEPT_EULA=Y
RUN apt-get update && apt-get install -y gnupg2
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
RUN apt-get update
RUN ACCEPT_EULA=Y apt-get -y --no-install-recommends install msodbcsql17 unixodbc-dev
RUN pecl install sqlsrv
RUN pecl install pdo_sqlsrv
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv

RUN apt-get -y update \
&& apt-get install -y zlib1g-dev libicu-dev g++ locales gettext git\
libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure gettext \
&& docker-php-ext-install intl gettext

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www
COPY --chown=www:www . /var/www
RUN chown -R www-data:www-data /var/www

USER www
RUN composer install

EXPOSE 9000