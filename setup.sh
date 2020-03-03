#!/bin/bash
docker-compose exec app composer install
docker-compose exec app php artisan migrate
docker-compose exec app php artisan passport:install
