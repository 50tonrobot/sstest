FROM php:5.6-apache
COPY config/php.ini /usr/local/etc/php
COPY notes/ /var/www
COPY notes/public/ /var/www/html
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev vim locate \
    && a2enmod rewrite \
    && apt-get install -y sqlite3 libsqlite3-dev \
    && pecl install memcached-2.2.0 \
    && docker-php-ext-install pdo_sqlite \
    && docker-php-ext-enable memcached pdo_sqlite
ADD config/init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh \
    && chown -R www-data:www-data /var/www/storage
RUN echo ServerName ${HOSTNAME} >> /etc/apache2/conf-enabled/servername.conf
ENTRYPOINT /usr/local/bin/init.sh && /bin/bash
