BACKEND_ENV=docker run --rm -i --user $(shell id -u):$(shell id -g) -v $(shell pwd)/packages/backend:/var/www/html -w /var/www/html laravelsail/php82-composer:latest
SAIL=$(shell pwd)/packages/backend/vendor/bin/sail

setup-local:
	(cd utils && cp .env_example .env)
	@make erd-generate
	@make backend-setup
	@make frontend-setup

setup-ci:
	@make frontend-setup
	@make backend-setup

swagger-ui:
	(cd utils && docker compose up swagger_ui -d --no-recreate )
	open http://localhost:8080/

erd-generate:
	(cd utils && docker compose run --rm utils yarn prisma:generate)

frontend-setup:
	(cd packages/frontend && yarn install)

frontend-up-dev:
	(cd packages/frontend && NODE_ENV=development && yarn dev)

frontend-build:
	(cd packages/frontend && yarn build)

frontend-build-cloudflare:
	(cd packages/frontend && corepack enable yarn && yarn install && yarn build)

backend-setup:
	(cd packages/backend && cp .env.example .env)
	(cd packages/backend && \
	${BACKEND_ENV} composer install --ignore-platform-reqs)
	(cd packages/backend && \
	${BACKEND_ENV} php artisan key:generate)
	@make backend-up
	@make backend-generate
	(cd packages/backend && ${SAIL} pint)
	@make backend-insight-fix

backend-generate:
	(cd packages/backend && \
	${BACKEND_ENV} php artisan ide-helper:generate)
	@make backend-migrate
	@make backend-annotation
	@make backend-oas-generate

backend-up:
	(cd packages/backend && ${SAIL} up -d --build && \
	sleep 10)

backend-down:
	(cd packages/backend && ${SAIL} down)

backend-destroy:
	(cd packages/backend && ${SAIL} down -v)

backend-test:
	(cd packages/backend && ${SAIL} test --coverage --coverage-clover clover.xml  )

backend-lint:
	(cd packages/backend && ${SAIL} pint)
	@make backend-insight-fix
	@make backend-phpstan

backend-oas-generate:
	(cd packages/backend && ${SAIL} artisan openapi:generate > $(shell pwd)/documents/api/schema.json)

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

backend-infra-deploy:
	(cd packages/infra/ec2 && cp setup_base.sh setup.sh && cat .credentials/cf_tunnel.sh >> setup.sh && terraform apply)

backend-infra-plan:
	(cd packages/infra/ec2 && cp setup_base.sh setup.sh && cat .credentials/cf_tunnel.sh >> setup.sh && terraform plan)

backend-infra-plan-ci:
	(cd packages/infra/ec2 && cp setup_base.sh setup.sh && terraform plan -no-color -input=false)

backend-infra-destroy:
	(cd packages/infra/ec2 && terraform destroy)

slide-build:
	(cd packages/intern-slide && yarn install && yarn build)

backend-insight:
	(cd packages/backend && ${SAIL} artisan insights --no-interaction)

backend-insight-fix:
	(cd packages/backend && ${SAIL}  artisan insights --no-interaction --fix)

backend-insight-ci:
	(cd packages/backend && ${SAIL} artisan insights -n --ansi --format=github-action)
