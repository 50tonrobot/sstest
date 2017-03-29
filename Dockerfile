FROM php:5.6-apache
COPY notes/ /var/www
COPY notes/public/ /var/www/html
