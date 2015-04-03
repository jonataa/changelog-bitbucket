<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Framework\Changelog;

class ChangelogCommand extends Command
{

  protected function configure()
  {
    $this
        ->setName('make')
        ->setDescription('Create the HTML changelog file from JIRA API (default: output.html)')
        ->addOption(
            'output', 
            null, 
            InputOption::VALUE_OPTIONAL,
            'If prefer, you can set up an output file diferent of changelog.html',
            './changelog.html'
          )
        ->addOption(
            'template', 
            null, 
            InputOption::VALUE_OPTIONAL,
            'If prefer, you can set up an template file diferent of templates/default.twig',
            './templates/default.twig'
          )
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {                
    $outputFile = $input->getOption('output');
    $template = $input->getOption('template');    

    $data = file_get_contents("php://stdin");
    
    $changelog = new Changelog($data);
    $html = $changelog->render($template);
    $isWritten = $changelog->createFile($outputFile, $html);

    if (! $isWritten)
      throw new \Exception("File '$outputFile' was not written correctly");
      
    $output->writeln("Congratulations! Your '$outputFile' was generated correctly :)");
  }

}
