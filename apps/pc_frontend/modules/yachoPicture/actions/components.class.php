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
    $toriList = array(
      'メジロ',
      'カワセミ',
      'オオルリ',
      'アカゲラ',
      'ハクセキレイ',
      'ヒバリ',
      'オシドリ',
      'ウグイス',
      'シジュウカラ',
      'モズ',
      'ウズラ',
      'タンチョウヅル',
      'コハクチョウ',
      'キジ',
      'ヤマドリ',
      'キビタキ',
      'シラコバト',
      'ホオジロ',
      'ユリカモメ',
      'カモメ',
      'ライチョウ',
      'ツグミ',
      'サンコウチョウ',
      'コノハズク',
      'シロチドリ',
      'カイツブリ',
      'オオミズナギドリ',
      'コウノトリ',
      'オオハクチョウ',
      'ホトトギス',
      'ナベヅル',
      'コマドリ',
      'カササギ',
      'ミサゴ',
      'トビ',
      'オジロワシ',
      'オオワシ',
      'オオタカ',
      'ハイタカ',
      'サシバ',
      'ノスリ',
      'ハイイロチュウヒ',
      'ハヤブサ',
      'チョウゲンボウ',
      'コジュケイ',
      'キジバト',
      'アオバト',
      'ジュウイチ',
      'ツツドリ',
      'カッコウ',
      'シマフクロウ',
      'トラフズク',
      'コミミズク',
      'アオバズク',
      'フクロウ',
      'ヨタカ',
      'アマツバメ',
      'ヤマショウビン',
      'アカショウビン',
      'ヤマセミ',
      'ブッポウソウ',
      'ヤツガシラ',
      'アオゲラ',
      'ヤマゲラ',
      'クマゲラ',
      'オオアカゲラ',
      'コゲラ',
      'コシアカツバメ',
      'ツバメ',
      'イワツバメ',
      'ツメナガセキレイ',
      'キセキレイ',
      'セグロセキレイ',
      'ビンズイ',
      'タヒバリ',
      'ヒヨドリ',
      'サンショウクイ',
      'チゴモズ',
      'アカモズ',
      'キレンジャク',
      'ヒレンジャク',
      'カワガラス',
      'ミソサザイ',
      'イワヒバリ',
      'カヤクグリ',
      'アカヒゲ',
      'ノゴマ',
      'コルリ',
      'ルリビタキ',
      'ノビタキ',
      'ジョウビタキ',
      'イソヒヨドリ',
      'トラツグミ',
      'マミジロ',
      'クロツグミ',
      'アカバラ',
      'アカコッコ',
      'シロハラ',
      'マミチャジナイ',
      'ヤブサメ',
      'オオセッカ',
      'シマセンニュウ',
      'マキノセンニュウ',
      'コヨシキリ',
      'オオヨシキリ',
      'メボソムシクイ',
      'エゾムシクイ',
      'センダイムシクイ',
      'キクイタダキ',
      'セッカ',
      'ムギマキ',
      'サメビタキ',
      'コサメビタキ',
      'エゾビタキ',
      'エナガ',
      'コガラ',
      'ヒガラ',
      'ヤマガラ',
      'ゴジュウカラ',
      'コチドリ',
      'キバシリ',
      'メグロ',
      'コジュリン',
      'シロハラホオジロ',
      'ホオアカ',
      'コホオアカ',
      'キマユホオジロ',
      'カシラダカ',
      'ミヤマホオジロ',
      'シマアオジ',
      'シマノジコ',
      'ノジコ',
      'アオジ',
      'クロジ',
      'オオジュリン',
      'アトリ',
      'カワラヒワ',
      'マヒワ',
      'ベニヒワ',
      'ハギマシコ',
      'オオマシコ',
      'ギンザンマシコ',
      'イスカ',
      'ベニマシコ',
      'ウソ',
      'シメ',
      'イカル',
      'ニュウナイスズメ',
      'スズメ',
      'コムクドリ',
    );
    $key = array_rand($toriList);
    $toriName = $toriList[$key];

    $linkUrl = 'http://ja.wikipedia.org/wiki/';
    $imageWidth = 250;


    $urlString = $toriName;
    //urlエンコード
    $urlString = urlencode($urlString);
    $linkUrl .= $urlString;

    $url = "http://ajax.googleapis.com/ajax/services/search/images";
    $url = $url."?v=1.0";
    $url = $url."&key=ABQIAAAAOPtPI5yGL-nFD6Z-kVoJxxQmO4LSR-cwvAgRQxlrUu2LJmLSXBRZ6rnUtzFGACVM0FRb2UWlx4CCpg";
    $url = $url."&rsz=large";
    $url = $url."&q=".$urlString;

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
    $this->linkUrl = $linkUrl;
    $this->imageWidth = $imageWidth;

    $i = mt_rand(0, 7);
    $this->imageUrl = $results[$i]->url;
  }

  public function executeYachoPictureSideList()
  {
    //検索文字列の設定
    $toriList = array(
      'メジロ',
      'カワセミ',
      'オオルリ',
      'アカゲラ',
      'ハクセキレイ',
      'ヒバリ',
      'オシドリ',
      'ウグイス',
      'シジュウカラ',
      'モズ',
      'ウズラ',
      'タンチョウヅル',
      'コハクチョウ',
      'キジ',
      'ヤマドリ',
      'キビタキ',
      'シラコバト',
      'ホオジロ',
      'ユリカモメ',
      'カモメ',
      'ライチョウ',
      'ツグミ',
      'サンコウチョウ',
      'コノハズク',
      'シロチドリ',
      'カイツブリ',
      'オオミズナギドリ',
      'コウノトリ',
      'オオハクチョウ',
      'ホトトギス',
      'ナベヅル',
      'コマドリ',
      'カササギ',
      'ミサゴ',
      'トビ',
      'オジロワシ',
      'オオワシ',
      'オオタカ',
      'ハイタカ',
      'サシバ',
      'ノスリ',
      'ハイイロチュウヒ',
      'ハヤブサ',
      'チョウゲンボウ',
      'コジュケイ',
      'キジバト',
      'アオバト',
      'ジュウイチ',
      'ツツドリ',
      'カッコウ',
      'シマフクロウ',
      'トラフズク',
      'コミミズク',
      'アオバズク',
      'フクロウ',
      'ヨタカ',
      'アマツバメ',
      'ヤマショウビン',
      'アカショウビン',
      'ヤマセミ',
      'ブッポウソウ',
      'ヤツガシラ',
      'アオゲラ',
      'ヤマゲラ',
      'クマゲラ',
      'オオアカゲラ',
      'コゲラ',
      'コシアカツバメ',
      'ツバメ',
      'イワツバメ',
      'ツメナガセキレイ',
      'キセキレイ',
      'セグロセキレイ',
      'ビンズイ',
      'タヒバリ',
      'ヒヨドリ',
      'サンショウクイ',
      'チゴモズ',
      'アカモズ',
      'キレンジャク',
      'ヒレンジャク',
      'カワガラス',
      'ミソサザイ',
      'イワヒバリ',
      'カヤクグリ',
      'アカヒゲ',
      'ノゴマ',
      'コルリ',
      'ルリビタキ',
      'ノビタキ',
      'ジョウビタキ',
      'イソヒヨドリ',
      'トラツグミ',
      'マミジロ',
      'クロツグミ',
      'アカバラ',
      'アカコッコ',
      'シロハラ',
      'マミチャジナイ',
      'ヤブサメ',
      'オオセッカ',
      'シマセンニュウ',
      'マキノセンニュウ',
      'コヨシキリ',
      'オオヨシキリ',
      'メボソムシクイ',
      'エゾムシクイ',
      'センダイムシクイ',
      'キクイタダキ',
      'セッカ',
      'ムギマキ',
      'サメビタキ',
      'コサメビタキ',
      'エゾビタキ',
      'エナガ',
      'コガラ',
      'ヒガラ',
      'ヤマガラ',
      'ゴジュウカラ',
      'コチドリ',
      'キバシリ',
      'メグロ',
      'コジュリン',
      'シロハラホオジロ',
      'ホオアカ',
      'コホオアカ',
      'キマユホオジロ',
      'カシラダカ',
      'ミヤマホオジロ',
      'シマアオジ',
      'シマノジコ',
      'ノジコ',
      'アオジ',
      'クロジ',
      'オオジュリン',
      'アトリ',
      'カワラヒワ',
      'マヒワ',
      'ベニヒワ',
      'ハギマシコ',
      'オオマシコ',
      'ギンザンマシコ',
      'イスカ',
      'ベニマシコ',
      'ウソ',
      'シメ',
      'イカル',
      'ニュウナイスズメ',
      'スズメ',
      'コムクドリ',
    );
    $key = array_rand($toriList);
    $toriName = $toriList[$key];

    $linkUrl = 'http://ja.wikipedia.org/wiki/';
    $imageWidth = 150;


    $urlString = $toriName;
    //urlエンコード
    $urlString = urlencode($urlString);
    $linkUrl .= $urlString;

    $url = "http://ajax.googleapis.com/ajax/services/search/images";
    $url = $url."?v=1.0";
    $url = $url."&key=ABQIAAAAOPtPI5yGL-nFD6Z-kVoJxxQmO4LSR-cwvAgRQxlrUu2LJmLSXBRZ6rnUtzFGACVM0FRb2UWlx4CCpg";
    $url = $url."&rsz=large";
    $url = $url."&safe=active";
    $url = $url."&q=".$urlString;

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
    $this->linkUrl = $linkUrl;
    $this->imageWidth = $imageWidth;

    $i = mt_rand(0, 7);
    $this->imageUrl = $results[$i]->url;
  }
}
