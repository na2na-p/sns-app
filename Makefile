BACEND_ENV=docker run --rm -i --user $(shell id -u):$(shell id -g) -v $(shell pwd)/packages/backend:/var/www/html -w /var/www/html laravelsail/php82-composer:latest
SAIL=$(shell pwd)/packages/backend/vendor/bin/sail

setup-local:
	(cd utils && cp .env_example .env)
	@make erd-generate
	@make backend-setup

setup-ci:
	@make backend-setup
	@make backend-up

erd-generate:
	(cd utils && docker compose run --rm utils yarn prisma:generate)

backend-setup:
	(cd packages/backend && cp .env.example .env)
	(cd packages/backend && \
	${BACEND_ENV} composer install --ignore-platform-reqs)
	(cd packages/backend && \
	${BACEND_ENV} php artisan key:generate)

backend-up:
	(cd packages/backend && ${SAIL} up -d --build)

backend-down:
	(cd packages/backend && ${SAIL} down)

backend-destroy:
	(cd packages/backend && ${SAIL} down -v)

backend-test:
	(cd packages/backend && ${SAIL} test)

backend-lint:
	(cd packages/backend && ${SAIL} pint)

