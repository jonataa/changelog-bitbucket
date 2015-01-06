# Changelog JIRA

## Basic Usage

```shell
$ cat tests/mockresponses/issues.json | php src/application.php make > output.html
```

## Tests

```shell
$ composer install
$ php vendor/bin/phpunit --bootstrap=vendor/autoload.php
```

## Docs

- [Jira Doc](https://docs.atlassian.com/jira/REST/latest/)


## Implemented

- Convert the JSON response to Objects Model
- Generate the HTML Template from Objects Model
- Support the Twig templates 

## TO DO

- Build as a CLI tool using Symfony Console
- Output a HTML file with changelog informations
- Connect to JIRA API using the Basic Authentication
- Import the Issue informations from JIRA API
- Build .phar