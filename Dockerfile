FROM php:7.3-apache

LABEL maintainer "genzouw <genzouw@gmail.com>"

RUN apt-get update -y \
  && apt-get -y install \
    --no-install-recommends \
    git \
    libgmp-dev \
    libpq-dev \
    unzip \
    zlib1g-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  ;

RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h \
  && docker-php-ext-install \
    gmp \
    mbstring \
  ;

RUN cd /usr/local/bin \
  && php -r "readfile('https://getcomposer.org/installer');" | php \
  && chmod u+x /usr/local/bin/composer.phar \
  && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer \
  ;
