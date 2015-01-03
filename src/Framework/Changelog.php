<?php

namespace Framework;

use Framework\Model\VersionFactory;

class Changelog
{

  protected $versions;

  public function __construct($data)
  {
    if (isset($data['versions']) && !empty($data['versions']))
      $this->versions = $data['versions'];
  }

  public function getVersions()
  {
    return $this->versions;
  }  

}