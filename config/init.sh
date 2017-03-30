#!/bin/bash
service apache2 restart;
php /var/www/artisan migrate;
#password is YxeK32Xjl8Z
sqlite3 /var/www/database/database.sqlite "INSERT INTO users (name,email,password,created_at,updated_at) VALUES ( 'test', 'test@test.com', '\$2y\$10\$wk/K00vNYVSdgsOSQPlDr.Df/vKGcJfBOU2G064SSGEh/61o0iT3G', '2015-10-12 02:40:15', '2015-10-12 02:40:15' );"
