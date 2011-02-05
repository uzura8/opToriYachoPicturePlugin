<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opToriYachoPicturePluginToolkit
 *
 * @package    OpenPNE
 * @subpackage opToriYachoPicture
 * @author     uzura8 <uzuranoie@gmail.com>
 */
class opToriYachoPicturePluginToolkit
{
  static public function getYachoPictureSearchResults($searchWord)
  {
    $url  = "http://ajax.googleapis.com/ajax/services/search/images";
    $url .= "?v=1.0";
    $url .= "&key=".sfConfig::get('app_tori_yacho_picture_google_api_key');
    $url .= "&rsz=large";
    if (sfConfig::get('app_tori_yacho_picture_is_enable_safe_search_mode'))
    {
      $url .= "&safe=active";
    }
    $url .= "&q=".urlencode($searchWord);

    // sendRequest
    // note how referer is set manually
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, "http://factory.uzuralife.com/labo/google_search_api_img_onserv.php");
    $body = curl_exec($ch);
    curl_close($ch);

    // now, process the JSON string
    $json = json_decode($body);
    //ステータスコードが200以外の場合はエラー
    if($json->responseStatus != 200)
    {
      return array();
    }

    $responseData = $json->responseData;

    return $responseData->results;
  }
}
