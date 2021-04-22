# alpine
FROM php:7.3.5-fpm

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
       locales \
       git \
       zip \
       unzip \
       inetutils-ping \
       nginx \
    && pecl install xdebug \
    && apt-get autoremove --purge \
    && apt-get -y clean \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install \
    opcache \
    pdo_mysql \
    mysqli

RUN docker-php-ext-enable \
    opcache \
    xdebug

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configuring the server
ADD ./config/php/conf.d/php.override.ini /usr/local/etc/php/conf.d/

RUN touch /var/log/php_errors.log && chmod 777 /var/log/php_errors.log

ADD ./config/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/

RUN rm -f /usr/local/etc/php-fpm.d/zz-docker.conf

RUN touch /var/log/fpm-php.www.log && chmod 777 /var/log/fpm-php.www.log

ADD ./config/nginx/site-enabled/default /etc/nginx/sites-enabled/

RUN /etc/init.d/nginx restart

RUN apt-get update \
    && apt-get install -y \
       icu-devtools \
       libicu-dev \
       libicu57 \
       libxml2-dev \
       libxslt1-dev
RUN docker-php-ext-install xsl

RUN apt-get update \
    && apt-get install -y zlib1g-dev \
       libpng-dev \
       zip \
       libzip-dev

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

RUN apt-get update \
    && apt-get install -y libpng-dev

RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
    --with-gd \
    --with-webp-dir \
    --with-jpeg-dir \
    --with-png-dir \
    --with-zlib-dir \
    --with-xpm-dir \
    --with-freetype-dir \
    --enable-gd-native-ttf

RUN docker-php-ext-install gd

RUN chown -R www-data:www-data /var/www

WORKDIR /var/www/app

EXPOSE 80
EXPOSE 9000

CMD ["sh", "-c", "/etc/init.d/cron start; /etc/init.d/nginx start; php-fpm --nodaemonize"]
