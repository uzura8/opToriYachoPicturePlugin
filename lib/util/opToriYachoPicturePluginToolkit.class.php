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
    if (Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_use_safe_search_mode', true))
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

  static public function convertStrings2Array($str)
  {
    $str = str_replace("\r\n", "\n", $str);
    $str = str_replace("\r", "\n", $str);
    $tmpArray = explode("\n", $str);

    $array = array();
    foreach ($tmpArray as $each)
    {
      $each = trim($each);
      if (!$each) continue;
      $array[] = $each;
    }

    return $array;
  }

  static public function getYachoNameList()
  {
    return <<<EOT
メジロ
カワセミ
オオルリ
アカゲラ
ハクセキレイ
ヒバリ
オシドリ
ウグイス
シジュウカラ
モズ
ウズラ
タンチョウヅル
コハクチョウ
キジ
ヤマドリ
キビタキ
シラコバト
ホオジロ
ユリカモメ
カモメ
ライチョウ
ツグミ
サンコウチョウ
コノハズク
シロチドリ
カイツブリ
オオミズナギドリ
コウノトリ
オオハクチョウ
ホトトギス
ナベヅル
コマドリ
カササギ
ミサゴ
トビ
オジロワシ
オオワシ
オオタカ
ハイタカ
サシバ
ノスリ
ハイイロチュウヒ
ハヤブサ
チョウゲンボウ
コジュケイ
キジバト
アオバト
ジュウイチ
ツツドリ
カッコウ
シマフクロウ
トラフズク
コミミズク
アオバズク
フクロウ
ヨタカ
アマツバメ
ヤマショウビン
アカショウビン
ヤマセミ
ブッポウソウ
ヤツガシラ
アオゲラ
ヤマゲラ
クマゲラ
オオアカゲラ
コゲラ
コシアカツバメ
ツバメ
イワツバメ
ツメナガセキレイ
キセキレイ
セグロセキレイ
ビンズイ
タヒバリ
ヒヨドリ
サンショウクイ
チゴモズ
アカモズ
キレンジャク
ヒレンジャク
カワガラス
ミソサザイ
イワヒバリ
カヤクグリ
アカヒゲ
ノゴマ
コルリ
ルリビタキ
ノビタキ
ジョウビタキ
イソヒヨドリ
トラツグミ
マミジロ
クロツグミ
アカバラ
アカコッコ
シロハラ
マミチャジナイ
ヤブサメ
オオセッカ
シマセンニュウ
マキノセンニュウ
コヨシキリ
オオヨシキリ
メボソムシクイ
エゾムシクイ
センダイムシクイ
キクイタダキ
セッカ
ムギマキ
サメビタキ
コサメビタキ
エゾビタキ
エナガ
コガラ
ヒガラ
ヤマガラ
ゴジュウカラ
コチドリ
キバシリ
メグロ
コジュリン
シロハラホオジロ
ホオアカ
コホオアカ
キマユホオジロ
カシラダカ
ミヤマホオジロ
シマアオジ
シマノジコ
ノジコ
アオジ
クロジ
オオジュリン
アトリ
カワラヒワ
マヒワ
ベニヒワ
ハギマシコ
オオマシコ
ギンザンマシコ
イスカ
ベニマシコ
ウソ
シメ
イカル
ニュウナイスズメ
スズメ
コムクドリ
EOT;
  }
}
