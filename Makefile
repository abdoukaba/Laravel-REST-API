.DEFAULT_GOAL := go

.PHONY: go
go: down up

.PHONY: build
build: down rebuild up

.PHONY: rebuild
rebuild:
	docker-compose build

.PHONY: up
up:
	docker-compose up -d --remove-orphans
	docker exec -it laravel-app composer install
	docker exec -it laravel-app php artisan migrate

.PHONY: down
down:
	docker-compose down

.PHONY: shell
shell:
	docker exec -it laravel-app sh

.PHONY: logs
logs:
	docker-compose logs -f --tail=100

.PHONY: test
test:
	docker exec -it laravel-app php artisan test
