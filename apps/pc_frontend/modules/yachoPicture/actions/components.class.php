<?php
/**
 * yachoPicture components.
 *
 * @package    OpenPNE
 * @subpackage opToriYachoPicturePlugin
 * @author     uzura8 <uzuranoie@gmail.com>
 */
class yachoPictureComponents extends sfComponents
{
  public function executeYachoPictureHomeList()
  {
    $pictures = $this->getYachoPictures('contents');
    foreach ($pictures as $key => $value)
    {
      $this->$key = $value;
    }
  }

  public function executeYachoPictureSideList()
  {
    $pictures = $this->getYachoPictures();
    foreach ($pictures as $key => $value)
    {
      $this->$key = $value;
    }
  }

  public function getYachoPictures($type = 'side')
  {
    $res = array();

    $toriName = $this->getRandamYachoName();
    $res['toriName']   = $toriName;

    $imageWidth = 150;
    if (sfConfig::get('app_tori_yacho_picture_image_width_'.$type))
    {
      $imageWidth = sfConfig::get('app_tori_yacho_picture_image_width_'.$type);
    }
    $res['imageWidth'] = $imageWidth;

    $linkUrl = '';
    if (Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_use_wiki_link', true))
    {
      $linkUrl  = 'http://ja.wikipedia.org/wiki/';
      $linkUrl .= urlencode($toriName);
    }
    $res['linkUrl'] = $linkUrl;

    $imageUrl = '';
    if (sfConfig::get('app_tori_yacho_picture_is_enable_search_result_cache'))
    {
      $cache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_cache_dir').'/function'));
      $fc = new sfFunctionCache($cache);
      $results = $fc->call(array('opToriYachoPicturePluginToolkit', 'getYachoPictureSearchResults'), array($toriName));
    }
    else
    {
      $results = opToriYachoPicturePluginToolkit::getYachoPictureSearchResults($toriName);
    }

    if ($results)
    {
      $i = mt_rand(0, count($results));
      $imageUrl = $results[$i]->url;
    }
    $res['imageUrl'] = $imageUrl;

    return $res;
  }

  protected function getRandamYachoName()
  {
    $yachoNameStrings = Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_search_word_list', opToriYachoPicturePluginToolkit::getYachoNameList());
    $toriList = opToriYachoPicturePluginToolkit::convertStrings2Array($yachoNameStrings);
    $key = array_rand($toriList);

    return $toriList[$key];
  }
}
