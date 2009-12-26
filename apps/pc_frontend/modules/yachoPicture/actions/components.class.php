<?php
/**
 * yachoPicture components.
 *
 * @package    OpenPNE
 * @subpackage ashiato
 * @author     uechoco
 */
class yachoPictureComponents extends sfComponents
{
  public function executeYachoPictureHomeList()
  {
    //検索文字列の設定
    $toriList = array('カワセミ', 'キビタキ', 'オオルリ', 'ルリビタキ', 'ウズラ', 'シメ', 'シジュウカラ');
    $key = array_rand($toriList);
    $toriName = $toriList[$key];
    $url_string = $toriName;
    //urlエンコード
    $url_string = urlencode($url_string);
    $url = "http://ajax.googleapis.com/ajax/services/search/images";
    $url = $url."?v=1.0";
    $url = $url."&key=ABQIAAAAOPtPI5yGL-nFD6Z-kVoJxxQmO4LSR-cwvAgRQxlrUu2LJmLSXBRZ6rnUtzFGACVM0FRb2UWlx4CCpg";
//    $url = $url."&rsz=large";
    $url = $url."&q=".$url_string;

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
      //エラー処理を記述
      //exit();
    }

    $responseData = $json->responseData;
    $results = $responseData->results;
    if(!$results)
    {
      //エラー処理を記述
      //exit();
    }
    $this->toriName = $toriName;
    $this->toriPicture = $results[0];
  }
}
