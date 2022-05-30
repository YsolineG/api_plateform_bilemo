# API BileMo

API BileMo is an API developed in Symfony.

## Prerequisite

- PHP 8.0 min
- MySql 5.7
- Composer

## Installation

1. Clone the repository : `git clone https://github.com/YsolineG/api_plateform_bilemo.git`

2. Install composer packages : `composer install`

3. Configure the SQL DATABASE_URL connection string so that it can communicate with your local SQL database

4. Create a database for the project : `php bin/console doctrine:schema:create`

5. Run Doctrine migrations : `php bin/console doctrine:migrations:migrate`

6. To start the project : `symfony server:start`


