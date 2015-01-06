#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Console\Command\ChangelogCommand;
use Symfony\Component\Console\Application;

$application = new Application('Changelog Jira', '0.0.1-alpha');
$application->add(new ChangelogCommand);
$application->run();

