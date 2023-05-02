## Docker Setup
#### for linux
- build images : `make build`
- build + up services : `make up`
- stop services : `make down`
- down + up : `make restart`

#### for windows
- `cd path/to/app directory` then :
    - build images : `docker compose build`
    - up services : `docker compose up -d`
    - build + up services : `docker compose up -d --build`
    - down + up : `docker compose restart`

## Laravel env Setup
- for .env : edit `docker/configs/laravel-application/.env`

## Run Laravel
- go to http://localhost:84

## Run pgAdmin (PostgreSQL)
- go to http://localhost:5050

- PgAdmin4 username: `admin@admin.com`
- PgAdmin4 password: `admin`

- System : `PostgreSQL`
- Server : `db`
- username : `postgres`
- password : `postgres`
- database : `task-management-db`


