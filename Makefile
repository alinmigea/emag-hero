# Ensure SHELL is /bin/sh
SHELL = /bin/sh

.PHONY: build
install: ## Build the image
	@docker compose up -d --build --force-recreate emag-hero

.PHONY: ssh
ssh: ## SSH into image container
	@docker compose exec emag-hero ash

.PHONY: unit-tests
unit-tests: ## Run unit tests
	@vendor/bin/phpunit tests

.PHONY: run
run: ## Run the project
	@php ./src/index.php
