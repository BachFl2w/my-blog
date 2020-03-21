#!/bin/bash
docker-compose down

docker system prune -f
docker container prune -f
docker container stop $(docker container ls -aq)
docker container rm $(docker container ls -aq)
docker image prune -f
docker volume prune -f
docker network prune -f

# docker-compose up nginx mysql -d
docker-compose up -d

docker-compose exec app composer install
docker-compose exec app php artisan migrate
docker-compose exec app php artisan passport:install
