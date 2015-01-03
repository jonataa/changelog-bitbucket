<?php

use Framework\Changelog;

class ChangelogTest extends \PHPUnit_Framework_TestCase
{
  
  protected $changelog;

  public function setUp()
  {

    $versionsJson = <<<JSON
[{"self":"https://mederi.atlassian.net/rest/api/2/version/12211", "id":"12211", "name":"1.15.19", "archived":false, "released":true, "releaseDate":"2014-12-30", "userReleaseDate":"30/12/2014", "projectId":10001 }, {"self":"https://mederi.atlassian.net/rest/api/2/version/12212", "id":"12212", "name":"1.16.1", "archived":false, "released":true, "releaseDate":"2014-12-30", "userReleaseDate":"30/12/2014", "projectId":10001 } ]
JSON;

    $data = ['versions' => json_decode($versionsJson, true)];
    $this->changelog = new Changelog($data);
  }

  public function testGetVersions()
  {
    $versions = $this->changelog->getVersions();
    $this->assertCount(2, $versions);   
    $this->assertTrue($versions[0]['released']);
    $this->assertFalse($versions[0]['archived']);
  }

}