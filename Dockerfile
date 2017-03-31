FROM php:5.6-apache
COPY config/php.ini /usr/local/etc/php
COPY notes/ /var/www
COPY notes/public/ /var/www/html
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev vim locate mysql-client \
    && a2enmod rewrite \
    && apt-get install -y php5-mysqlnd \
    && pecl install memcached-2.2.0 \
    && docker-php-ext-install pdo_mysql mysqli \
    && docker-php-ext-enable memcached pdo_mysql mysqli
COPY config/init.sh /usr/local/bin/init.sh
COPY config/wait-for-mysql.sh /usr/local/bin/wait-for-mysql.sh
RUN chmod +x /usr/local/bin/init.sh \
    && chmod +x /usr/local/bin/wait-for-mysql.sh \
    && chown -R www-data:www-data /var/www/storage
RUN echo ServerName ${HOSTNAME} >> /etc/apache2/conf-enabled/servername.conf
