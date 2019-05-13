FROM php:7.3.5-apache

RUN apt-get update && apt-get install -y \
  file \
  git \
  libgmp-dev \
  libmcrypt-dev \
  libmhash-dev \
  libpq-dev \
  re2c \
  unzip \
  zlib1g-dev \
  ;

RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp
RUN docker-php-ext-install \
  pdo \
  pdo_pgsql \
  pgsql \
  mbstring \
  gmp \
  ;

COPY config/php.ini /usr/local/etc/php/
