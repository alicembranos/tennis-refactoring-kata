.PHONY: tests
tests:
	./vendor/bin/phpunit

check-cs:
	./vendor/bin/ecs check --ansi

fix-cs:
	./vendor/bin/ecs check --fix --ansi

apply-phpstan:
	./vendor/bin/phpstan analyse --ansi

tests-tennisGame3:
	./vendor/bin/phpunit --group tennis3

tests-tennisGame1:
	./vendor/bin/phpunit --group tennis1
