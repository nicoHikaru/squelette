FROM php:8.2.7-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.cong

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    locales apt-utils gnupg gnupg2 gnupg1 git sudo libicu-dev g++ libpng-dev libzip-dev libonig-dev libxslt-dev

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen &&\
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen

#install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    sudo mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring zip gd xsl
RUN pecl install apcu && docker-php-ext-enable apcu

#install yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update && sudo apt-get install -y yarn
# RUN sudo apt-get install npm
RUN yarn install
# RUN npm install

WORKDIR /var/www/