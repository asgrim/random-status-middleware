.PHONY: *

CLEAR_CONFIG_CACHE=rm -f storage/app/vars/*
OPTS=

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

test: ## run unit tests
	vendor/bin/phpunit

static-analysis: ## runs static analysis
	vendor/bin/psalm

check-cs: ## check coding standards
	vendor/bin/phpcs

fix-cs: ## auto-fix coding standards
	vendor/bin/phpcbf

build: static-analysis test check-cs ## run all build commands together
