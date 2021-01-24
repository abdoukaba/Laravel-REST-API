# 2 LARAVEL REST API

## Prerequisites

We use [Docker](https://www.docker.com/products/docker) to ensure the application behaviour is identical and
we have also provided an [Docker Compose](https://docs.docker.com/compose/) environment to help build your application.


### Stack

- Apache
- PHP 7.3
- Laravel 8
    - Configured via environment variables
- MySQL 5.7
    - No persistent volume

### Available Make Commands
- make - Starts container
- make build - Rebuilds container
- make shell - Drops you into a bash shell inside the container
- make logs - Trails container stdout/stderr logs
- make test - Executes unit tests within the container

## Instructions

1. Clone this repository.
1. Create a new branch called `develop`.
1. Run `docker-compose up -d` to start the development environment.
1. Run `docker exec -it laravel-app composer install` to install laravel.
1. Run `docker exec -it laravel-app php artisan migrate` to run the migrations.
1. Visit `http://localhost:18080/` to see the web server.


## Requirements

Build a basic API with that allows for rating of Sneakers

The API  conform to modern RESTful best practices and  provide the following functionality:

- List, create, read, update, and delete sneakers
- Search sneakers
- Rate sneakers 
    - Aggregated rating on sneaker


##### Sneakers

| Name   | Method      | URL                     | Protected |
| ---    | ---         | ---                     | ---       |
| List   | `GET`       | `/sneakers`             | ✘         |
| Create | `POST`      | `/sneakers`             | ✓         |
| Get    | `GET`       | `/sneakers/{id}`        | ✘         |
| Update | `PUT/PATCH` | `/sneakers/{id}`        | ✓         |
| Delete | `DELETE`    | `/sneakers/{id}`        | ✓         |
| Rate   | `POST`      | `/sneakers/{id}/rating` | ✘         |



### Schema

- **Sneaker**
    - Unique ID
    - Name
    - Hype Level (1-9)
    - Price
    - Release Date

Additionally, sneakers can be rated many times from 1-5 and a rating is never overwritten.



## The second API has the following key features:

- 1.     Login and token API
- 2.     Save a new note
- 3.     Update a previously saved note
- 4.     Delete a saved note
- 5.     Archive a note
- 6.     Unarchive a previously archived note
- 7.     List saved notes that aren't archived
- 8.     List notes that are archived
