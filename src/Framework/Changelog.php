<?php

namespace Framework;

class Changelog
{

  const TPL_SLUG = '{{%s}}';

  /** @var Array Collection with all changelog informations */
  protected $data = [];

  /** @var Array Collection with all issues group by released versions */
  protected $versions = [];

  /**
   * @param string $data Changelog informations as Json format
   */
  public function __construct($data)
  {
    $this->data = json_decode($data, true);    
    $this->versions = $this->groupByVersions($this->getIssues());
  }

  /**
   * To get a collection of the issues.
   * 
   * @return Array
   */
  public function getIssues()
  {
    return $this->data['issues'];
  }

  /**
   * To get the Jira data as Array Object.
   * 
   * @return Array
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * To get the collection issues group by the released version 
   * and issues type.
   * 
   * @return Array
   */
  public function getVersions()
  {        
    return $this->versions;
  }  

  /**
   * To group by versions and type all issues
   * 
   * @param  Array  $issues Issue collection
   * @return void
   */
  private function groupByVersions(Array $issues)
  {
    $versions = [];

    if (empty($issues))
      throw new InvalidArgumentException('Issues collection is empty');        

    foreach ($issues as $issue) {        
      if (isset($issue['fields']['fixVersions']) 
        && !empty($issue['fields']['fixVersions']))         
      {        
        foreach ($issue['fields']['fixVersions'] as $version) {          
          if ($this->isReleased($version)) {            
            $key       = $version['id'];          
            $issueType = $issue['fields']['issuetype']['name'];

            if (! isset($versions[$key]['meta']))  
              $versions[$key]['meta'] = $this->getMetaData($version, $key);                                                    

            $versions[$key]['issuesByType'][$issueType][] = $issue;
            $versions[$key]['issues'][] = $issue;
          }
        }
      }
    }    
    
    usort($versions, 'self::orderDesc');    

    return $versions;
  }

  /**
   * Order by descending order the release date and version name
   * 
   * @param  [type] $a
   * @param  [type] $b
   * @return int
   */
  public static function orderDesc($a, $b) 
  {        
    return $a['meta']['releaseDate'] >= $b['meta']['releaseDate'] 
           && $a['meta']['name'] >= $b['meta']['name']  ? 
           -1 : 
           1;
  }

  /**
   * Check if the version was released
   *
   * @param $version Version info
   * @return boolean
   */
  public function isReleased($version)
  {
    return isset($version['released']) && $version['released'];
  }

  /**
   * To get the metadata informations of a version
   * for continue to add the issues to the Collection.
   * 
   * @param  Array  $version Version informations 
   * @param  int    $key     Position in the collection
   * @return Array           Version metadata informations
   */
  private function getMetaData($version, $key)
  {
    $metaData = [
      'self'        => $version['self'],
      'id'          => $version['id'],
      'name'        => $version['name'],
      'archived'    => (bool) $version['archived'],
      'released'    => (bool) $version['released'],            
    ];     

    if (isset($version['releaseDate']))
      $metaData['releaseDate'] = \DateTime::createFromFormat('Y-m-d', $version['releaseDate']);

    if (isset($versions[$key]) && $metaData = $versions[$key]);

    return $metaData;
  }

  /**
   * To render the Changelog as HTML template
   * 
   * @param  string $templateFile Template file
   * @return string               Changelog output
   */
  public function render(
    $templateFile = './templates/default.twig'
  ) {
    $output = '';
    
    if (! (file_exists($templateFile) && is_readable($templateFile)))
      throw new \InvalidArgumentException("File not exist or It isn't readable", 1);    

    $loader = new \Twig_Loader_Filesystem('./');      
    $twig   = new \Twig_Environment($loader);

    if (! empty($this->versions)) {
      ob_start();
      echo $twig->render($templateFile, array('versions' => $this->versions));
      $output = ob_get_contents();
      ob_end_clean();
    }      

    return $output;   
  }

  /**
   * Write a text in a file
   * 
   * @param  string $filename Filename path
   * @param  string $content  An string or text
   * @return bool   TRUE if was write correctly or FALSE if not
   */
  public function createFile($filename, $content)
  {
    $r = file_put_contents($filename, $content);
    return $r === strlen($content);
  }

}