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
        ->setDescription('Print the HTML changelog file from JIRA API')        
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output)
    {                
        $data = file_get_contents("php://stdin");        
        
        $changelog = new Changelog($data);
        $html = $changelog->render('./templates/default.twig'); 

        $output->writeln($html);
    }

}
