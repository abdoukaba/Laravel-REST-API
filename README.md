# END. Backend Developer Test

The test should be completed using Laravel as it is our framework of choice for building services.

_Please do not create a public repository with your test in!_

## Prerequisites

We use [Docker](https://www.docker.com/products/docker) to ensure the application behaviour is identical and
we have also provided an [Docker Compose](https://docs.docker.com/compose/) environment to help build your application.


### Stack

- Apache
- PHP 7.3
- Laravel 6.4
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
1. Create a pull request from your `develop` branch to the master branch.
1. Inform us that the test is ready for review

## Requirements

Build a basic API with that allows for rating of Sneakers

The API **SHOULD** conform to modern RESTful best practices and **MUST** provide the following functionality:

- List, create, read, update, and delete sneakers
- Search sneakers
- Rate sneakers 
    - Aggregated rating on sneaker

### Endpoints

Your application **MUST** conform to the following structure and return the appropriate HTTP return status codes. 
Endpoints mark as protected below **SHOULD** require authentication to view.

##### Sneakers

| Name   | Method      | URL                     | Protected |
| ---    | ---         | ---                     | ---       |
| List   | `GET`       | `/sneakers`             | ✘         |
| Create | `POST`      | `/sneakers`             | ✓         |
| Get    | `GET`       | `/sneakers/{id}`        | ✘         |
| Update | `PUT/PATCH` | `/sneakers/{id}`        | ✓         |
| Delete | `DELETE`    | `/sneakers/{id}`        | ✓         |
| Rate   | `POST`      | `/sneakers/{id}/rating` | ✘         |

An endpoint for sneaker search **MUST** also be implemented and documented clearly.

### Schema

- **Sneaker**
    - Unique ID
    - Name
    - Hype Level (1-9)
    - Price
    - Release Date

Additionally, sneakers can be rated many times from 1-5 and a rating is never overwritten.

## Evaluation Criteria

These are some aspects we pay particular attention to:

- **MUST** write testable code and demonstrate unit testing it 
- **MUST** seed the database
- **SHOULD** pay attention to best security practices.
- **SHOULD** follow SOLID principles where appropriate.
- **MUST NOT** build a UI for this API.

The following earn you bonus points:

- Your answers during code review
- An informative, detailed description in the PR
- Following the industry standard style guide
- A git history with clear, concise commit messages.
- Pagination
- Additional testing methods