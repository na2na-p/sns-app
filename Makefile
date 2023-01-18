BACKEND_ENV=docker run --rm -i --user $(shell id -u):$(shell id -g) -v $(shell pwd)/packages/backend:/var/www/html -w /var/www/html laravelsail/php82-composer:latest
SAIL=$(shell pwd)/packages/backend/vendor/bin/sail

setup-local:
	(cd utils && cp .env_example .env)
	@make erd-generate
	@make frontend-setup
	@make backend-setup

setup-ci:
	@make frontend-setup
	@make backend-setup

erd-generate:
	(cd utils && docker compose run --rm utils yarn prisma:generate)

frontend-setup:
	(cd packages/frontend && yarn install)

backend-setup:
	(cd packages/backend && cp .env.example .env)
	(cd packages/backend && \
	${BACKEND_ENV} composer install --ignore-platform-reqs)
	(cd packages/backend && \
	${BACKEND_ENV} php artisan key:generate)
	@make backend-up
	@make backend-generate
	(cd packages/backend && ${SAIL} pint)

backend-generate:
	(cd packages/backend && \
	${BACKEND_ENV} php artisan ide-helper:generate)
	@make backend-migrate
	@make backend-annotation

backend-up:
	(cd packages/backend && ${SAIL} up -d --build && \
	sleep 10)

backend-down:
	(cd packages/backend && ${SAIL} down)

backend-destroy:
	(cd packages/backend && ${SAIL} down -v)

backend-test:
	(cd packages/backend && ${SAIL} test)

backend-lint:
	(cd packages/backend && ${SAIL} pint)
	@make backend-phpstan

backend-route-check:
	(cd packages/backend && ${SAIL} artisan route:list)

tinker:
	(cd packages/backend && ${SAIL} tinker)

backend-bash:
	(cd packages/backend && ${SAIL} bash)

backend-migrate:
	(cd packages/backend && ${SAIL} artisan migrate)

backend-annotation:
	(cd packages/backend && ${SAIL} artisan ide-helper:model --write)

backend-phpstan:
	(cd packages/backend && ${BACKEND_ENV} vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=2G)
