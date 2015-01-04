<?php

use Framework\Changelog;

class ChangelogTest extends \PHPUnit_Framework_TestCase
{
  
  protected $changelog;

  public function setUp()
  {
    $data = file_get_contents(__DIR__ . '/../mockresponses/issues.json');
    $this->changelog = new Changelog($data);
  }  

  public function testHas10Issues($total = 10)
  {
    $this->assertCount($total, $this->changelog->getIssues());
  }

  public function testCountVersions($total = 6)
  {
    $versions = $this->changelog->getVersions();
    $this->assertCount($total, $versions);    
    $this->assertEquals('1.16.1', current($versions)['name']);
  }

  public function testRender()
  {
    $output = $this->changelog->render('./templates/default.changelog');    
  }

}