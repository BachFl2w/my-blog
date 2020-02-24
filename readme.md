# My Blog

myblog.local

## Backend

**Laravel**

### Package

1. Passport

## Frontend

**ReactJs**

# Setup

## laradock

```bash
cd laradock

sudo chmod +x setup.sh

yes yes | ./setup.sh
```

# workspace

```bash
docker-compose exec workspace bash

# docker exec -it {workspace-container-id} bash
```


#!/bin/bash
# type `yes yes | ./remove_docker.sh`

docker system prune -f
docker container prune -f
docker container stop $(docker container ls -aq)
docker container rm $(docker container ls -aq)
docker image prune -f
docker volume prune -f
docker network prune -f

docker-compose down
docker-compose up -d nginx mysql
