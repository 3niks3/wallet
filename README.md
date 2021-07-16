# Virtual Wallet

## Task description
1. Symfony framework
2. Postgres SQL database
3. Doctrine ORM
4. Bootstrap

## More info
Console command to get new currency information `php bin/console get-currency-data`
After getting fresh information about currency it will be written in cache

## Setup guide
1. Go to root directory where is located `docker-compose.yaml` file
2. Build project `docker-compose build`
3. Run project `docker-compose up -d`
4. Install composer `docker exec box composer install`
5. Initiate database `docker exec box php bin/console doctrine:database:create`
6. Run migration `docker exec box php bin/console doctrine:migrations:migrate`
7. Get currency information form source `docker exec box php bin/console get-currency-data`
8. Open project `http://127.0.0.1:8000`

---
Trouble building docker file? Try `docker-compose build --force-rm --no-cache`