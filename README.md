# Changelog JIRA

## Basic Usage

```shell
$ curl -u <username>:<password> -X GET -H "Content-Type: application/json" https://localhost:8080/jira/rest/api/2/search | php src/application.php make > changelog.html
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
- Import the Issue informations from JIRA API
- Build .phar