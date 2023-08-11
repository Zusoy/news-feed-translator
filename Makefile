-include .env

STAGE ?= dev

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
