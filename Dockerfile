FROM php:8.0-fpm

COPY composer.lock composer.json /var/www/app/

WORKDIR /var/www/app/

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/app

RUN chown -R www-data:www-data \
        /var/www/app/storage/ \
        /var/www/app/bootstrap/

RUN chmod -R 777 /var/www/app/storage/

EXPOSE 9000
CMD ["php-fpm"]
