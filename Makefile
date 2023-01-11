erd-generate:
	(cd utils && docker compose run --rm utils yarn prisma:generate)
