#!/bin/bash
php /var/www/artisan migrate;
php /var/www/artisan db:seed --class=DatabaseSeeder
apache2-foreground

#  ERROR 2005 (HY000): Unknown MySQL server host 'sstest_mysql' (0)
