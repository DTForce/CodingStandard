# Coding Standard

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) preferring tabs and based on [Nette coding standard](http://nette.org/en/coding-standard).

**Check [rules overview](docs/en/dtforce-rules-overview.md) for examples.**


## Install

```sh
$ composer require dtforce/coding-standard --dev
```

## Usage

Run with Php_CodeSniffer:

```sh
$ vendor/bin/phpcs src --standard=vendor/dtforce/coding-standard/src/DTForceCodingStandard/ruleset.xml -p
```

That's all!


## PhpStorm Integration

If you use PhpStorm, code sniffer can check your syntax as you write. [How to integrate?](docs/en/integration-to-php-storm.md)


## How to be both Lazy and Safe

### Composer hook

In case you don't want to use Php_CodeSniffer manually for every change in the code you make, you can add pre-commit hook via `composer.json`:

```json
"scripts": {
	"post-install-cmd": [
		"DTForce\\CodingStandard\\Composer\\ScriptHandler::addPhpCsToPreCommitHook"
	],
	"post-update-cmd": [
		"DTForce\\CodingStandard\\Composer\\ScriptHandler::addPhpCsToPreCommitHook"
	]
}
```

**Every time you try to commit, Php_CodeSniffer will run on changed `.php` files only.**

This is much faster than checking whole project, running manually or wait for CI.

*Pretty cool, huh?*
