-include .env

STAGE ?= dev
CI ?= 0

####################
# STACK MANAGEMENT #
####################

.PHONY: build
build:
	docker-compose build

.PHONY: start
start:
	docker-compose up -d --remove-orphans

.PHONY: stop
stop:
	docker-compose stop

.PHONY: kill
kill:
	docker-compose down

#######
# API #
#######

PHONY: api-shell
api-shell:
	@docker exec -it "$$(docker ps -q -f name=news-feed-translator_api)" sh

.PHONY: api-migrate
api-migrate:
	@docker exec -it "$$(docker ps -q -f name=news-feed-translator_api)" ./bin/console do:mi:mi --no-interaction

#########
# TOOLS #
#########

.PHONY: phpstan
phpstan:
	docker-compose -f docker-compose.tools.yaml build phpstan > /dev/null
	docker-compose -f docker-compose.tools.yaml run --rm --user=$$(id -u) -w /code --entrypoint=sh phpstan -c "composer install $(COMPOSER_OPTIONS)"
ifeq ($(CI),1)
	docker-compose -f docker-compose.tools.yaml run --rm --user=$$(id -u) -w /code --entrypoint=sh phpstan -c "phpstan analyse --memory-limit=-1 --error-format=raw --no-progress -v"
else
	docker-compose -f docker-compose.tools.yaml run --rm --user=$$(id -u) -w /code --entrypoint=sh phpstan -c "phpstan analyse --memory-limit=-1"
endif
