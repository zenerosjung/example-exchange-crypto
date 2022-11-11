# How to Run via Docker
## 1 RUN via Docker-compose
    # docker-compose build && docker-compose up -d
# 2 Remote Docker
Open Terminal app and Run check container list 

    # docker ps

Example show process docker running

    CONTAINER ID   IMAGE                                         COMMAND                  CREATED          STATUS          PORTS                                NAMES
    9e6d2dfa2bad   example-exchange-crypto_exchange_crypto_web   "docker-php-entrypoi…"   50 seconds ago   Up 44 seconds   0.0.0.0:18000->80/tcp                exchange_crypto_web
    26f6dee50a0b   mysql                                         "docker-entrypoint.s…"   50 seconds ago   Up 46 seconds   33060/tcp, 0.0.0.0:18001->3306/tcp   exchange_crypto_mysql

Copy 'CONTAINER ID' from name 'exchange_crypto_web' and cmd exec docker

    # docker exec -it 9e6d2dfa2bad bash

# 3 Run Create database
    root@9e6d2dfa2bad:/var/www/html# php artisan make:database
# 4 Run Migration database
    root@9e6d2dfa2bad:/var/www/html# php artisan migrate
# 5 Run Seeder database
    root@9e6d2dfa2bad:/var/www/html# php artisan db:seed
# 6 Run Migration and Seed (Optional)
    root@9e6d2dfa2bad:/var/www/html# php artisan migrate:fresh --seed
# 7 Exit from Docker and Open on your Browser
    https://0.0.0.0:18000
