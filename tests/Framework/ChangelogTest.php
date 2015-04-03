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
    $this->assertEquals('1.16.1', current($versions)['meta']['name']);
  }

  /** @todo */
  public function testRender()
  {
    $output = $this->changelog->render('./templates/default.twig');
  }

  public function testOrderByReleasedDateDesc()
  {
    $a['meta']['name']        = '1.16';
    $a['meta']['releaseDate'] = \DateTime::createFromFormat('Y-m-d', '2015-01-10');    
    $b['meta']['name']        = '1.16.1';
    $b['meta']['releaseDate'] = \DateTime::createFromFormat('Y-m-d', '2015-02-10');        
    
    $this->assertEquals(1, Changelog::orderDesc($a, $b));    
  }

  public function testCreateFile($filename = './tests/output.html', $content = 'Fizz Buzz') 
  {
    $r = $this->changelog->createFile($filename, $content);    
    $this->assertEquals(strlen($content), $r);
    $this->assertEquals($content, file_get_contents($filename));
    unlink($filename);
  }

}