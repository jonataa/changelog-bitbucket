# Changelog JIRA [![Build Status](https://travis-ci.org/jonataa/changelog-jira.svg?branch=master)](https://travis-ci.org/jonataa/changelog-jira)
This project is an automation CLI Tool for generate the HTML Changelog file from [JIRA API](https://docs.atlassian.com/jira/REST/latest/). 

## Basic Usage

```shell
$ curl -u <username>:<password> -X GET -H "Content-Type: application/json" \
https://<myurl>/rest/api/2/search | php src/application.php make --output changelog.html
```

## Help Tool

```shell
Changelog Jira Tool

Usage:
 [options] command [arguments]

Options:
 --help (-h)           Display this help message.
 --quiet (-q)          Do not output any message.
 --verbose (-v|vv|vvv) Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug.
 --version (-V)        Display this application version.
 --ansi                Force ANSI output.
 --no-ansi             Disable ANSI output.
 --no-interaction (-n) Do not ask any interactive question.

Available commands:
 help   Displays help for a command
 list   Lists commands
 make   Create the HTML changelog file from JIRA API (default: changelog.html)
```

## Running the Tests

```shell
$ composer install
$ php vendor/bin/phpunit
```

## Docs

- [Jira Doc](https://docs.atlassian.com/jira/REST/latest/)

## Implemented

- Convert the JSON response to Objects Model
- Generate the HTML Template from Objects Model
- Support the Twig templates 
- Build as a CLI tool using Symfony Console
- Print a HTML file with changelog informations
- Order by descending order the Release date

## TO DO

- Build .phar
