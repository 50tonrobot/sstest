The following Pre-Requisites are needed:
  - Composer
  - Lumen Micro-Framework v5.2
  - Mysql Server

The Lumen .env file has been configured with the following:
/*************************
 *   DB_CONNECTION=mysql
 *   DB_HOST=127.0.0.1
 *   DB_PORT=3306
 *   DB_DATABASE=notes_app
 *   DB_USERNAME=root
 *   DB_PASSWORD=dTRKn3JPWbAAxRE42uE3dkFaJOC7nuT9
 *************************/

You can configure your mysql server according to these settings; 
  or update them in the .env file.

To create the test user, you will need to execute this query:

INSERT INTO users (name,email,password,created_at,updated_at)
VALUES (  'test',
          'test@test.com',
          '$2y$10$Q7hi.IQlFFY3A96BJveDtOPQ9Nf40i2Vf4QV0g8IoDYA8RZtgTD06',
          '2015-10-12 02:40:15',
          '2015-10-12 02:40:15'
        );

*Additional Notes on Lumen v5.2*

"Only Stateless APIs

Lumen 5.2 represents a shift on slimming Lumen to focus solely on serving stateless, JSON APIs. As such, sessions and views are no longer included with the framework. If you need access to these features, you should use the full Laravel framework. Upgrading your Lumen application to the full Laravel framework mainly involves copying your routes and classes over into a fresh installation of Laravel. Since Laravel and Lumen share many of the same components, your classes should not require any modification."

quoted from - https://lumen.laravel.com/docs/5.2/releases#5.2.0


