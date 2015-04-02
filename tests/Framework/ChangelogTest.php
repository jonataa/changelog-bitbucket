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

  /** @todo */
  public function testRender()
  {
    $output = $this->changelog->render();
    //die($output);
  }

  public function testOrderByReleasedDateDesc()
  {
    $a['name']        = '1.16';
    $a['releaseDate'] = \DateTime::createFromFormat('Y-m-d', '2015-01-10');    
    $b['name']        = '1.16.1';
    $b['releaseDate'] = \DateTime::createFromFormat('Y-m-d', '2015-02-10');        
    
    $this->assertEquals(1, Changelog::orderDesc($a, $b));    

  }

}