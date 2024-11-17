build:
	docker-compose build
stop:
	docker-compose stop
up:
	docker compose up -d
composer-update:
	docker exec -it my_theresa_assessment-app-1 bash -c "composer update"
migrate:
	docker exec -it my_theresa_assessment-app-1 bash -c "php artisan migrate"

run:
	docker compose build
	docker compose up -d

paratest:
	docker compose exec app ./vendor/bin/phpunit

