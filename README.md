# Changelog JIRA

## Tests

```shell
$ composer install
$ php vendor/bin/phpunit --bootstrap=vendor/autoload.php
```

## Docs

- [Jira Doc](https://docs.atlassian.com/jira/REST/latest/)

## TO DO

- Convert the JSON response to Objects Model
- Generate the HTML Template from Objects Model
- Support the Twig templates 
- Output a HTML file with changelog informations
- Build as a CLI tool using Symfony Console
- Connect to JIRA API using the Basic Authentication
- Import the Versions from JIRA API