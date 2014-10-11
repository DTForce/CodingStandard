# Zenify/CodingStandard

[![Build Status](https://travis-ci.org/Zenify/CodingStandard.svg?branch=master)](https://travis-ci.org/Zenify/CodingStandard)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/coding-standard.svg)](https://packagist.org/packages/zenify/coding-standard)
[![Latest stable](https://img.shields.io/packagist/v/zenify/coding-standard.svg)](https://packagist.org/packages/zenify/coding-standard)

Set of rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) based on [PGS-2](http://www.php-fg.org/pgs-2/) and [Nette CS](http://nette.org/en/coding-standard).

Oppose to the most default rules you can change all numerical parameters.


## Usage

Install via composer:

```sh
$ composer require zenify/coding-standard
```

And run Php_CodeSniffer:

```sh
$ vendor/bin/phpcs src --standard=vendor/zenify/coding-standard/src/ZenifyCodingStandard/ruleset.xml
```


## How to: own rules 

In case you want to create your own rules, here are some sources to start with:

- [Nice explanatory tutorial](http://blog.mayflower.de/631-Creating-coding-standards-for-PHP_CodeSniffer.html)
- [Overview of default rules with examples](http://edorian.github.io/php-coding-standard-generator/#phpcs)
- [Post on Why to add CS as part of your projects](http://edorian.github.io/2013-03-13-Please-ship-your-own-coding-standard-as-part/)
