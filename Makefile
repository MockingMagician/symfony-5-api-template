.PHONY: chained-tests
chained-tests: phpstan phpcs-dry-run tests-unit ## Run phpstan, phpcs and PHPUnit tests 'Unit' suite

.PHONY: tests
tests-unit: ## Launch PHPUnit tests
	bin/phpunit --colors=always --testdox

.PHONY: tests-with-coverage
tests-unit-with-coverage: ## Launch PHPUnit tests with coverage
	rm -Rf .coverage; XDEBUG_MODE=coverage bin/phpunit --colors=always --testdox --coverage-html .coverage

.PHONY: phpcs
phpcs: ## Apply PHP CS fixes
	if [ ! -d "./tools/php-cs-fixer/vendor" ]; then \
  		(cd ./tools/php-cs-fixer && composer install -v); \
  	fi
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix

.PHONY: phpcs-dry-run
phpcs-dry-run: ## Coding style checks
	if [ ! -d "./tools/php-cs-fixer/vendor" ]; then \
  		(cd ./tools/php-cs-fixer && composer install -v); \
  	fi
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --dry-run

.PHONY: phpstan
phpstan: ## Static analysis
	vendor/bin/phpstan analyse

.PHONY: help
help: ## Display this help message
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
