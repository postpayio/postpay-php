help:
	@echo "Please use \`make <target>' where <target> is one of"
	@echo "  test       to perform unit tests."
	@echo "  coverage   to perform unit tests with code coverage."
	@echo "  analyse    to discover bugs in the code."
	@echo "  fix        to automatically fix PHP Coding Standards issues."

test:
	@vendor/bin/phpunit

coverage:
	@vendor/bin/phpunit --coverage-text

analyse:
	@vendor/bin/phpstan analyse

fix:
	@php-cs-fixer fix

.PHONY: test coverage analyse fix
