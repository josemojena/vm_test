FROM php:8.0.2-cli
COPY . /usr/src/vm
WORKDIR /usr/src/vm
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
RUN alias composer='php /usr/bin/composer'
RUN composer install
CMD [ "php", "./app.php" ]