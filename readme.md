# My Blog
myblog.local

## Backend

**Database:** https://mysql.tutorials24x7.com/blog/guide-to-design-a-database-for-blog-management-in-mysql

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


<!-- #!/bin/bash
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
-->

# setup docker
https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose

## mysql
```bash
docker-compose exec db bash

mysql -u root -p

GRANT ALL ON my_blog.* TO 'root'@'%' IDENTIFIED BY 'root';

FLUSH PRIVILEGES;
```
