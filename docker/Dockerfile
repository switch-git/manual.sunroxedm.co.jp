FROM php:8.1.12-apache
COPY ./php/php.ini /usr/local/etc/php/
COPY ./apache/*.conf /etc/apache2/sites-available/

# zip/解凍/vimエディターのインストール
RUN apt-get update \
&& apt-get install -y zlib1g-dev \
&& apt-get install -y libzip-dev \
&& docker-php-ext-install zip \
&& apt-get install -y unzip

# php/pdoのインストール
RUN apt-get update \
  && apt-get install -y zlib1g-dev libpq-dev mariadb-client unzip\
  && docker-php-ext-install zip pdo_mysql mysqli \
  && docker-php-ext-enable mysqli

# .htaccessを使う
RUN cd /etc/apache2/mods-enabled \
    && ln -s ../mods-available/rewrite.load
