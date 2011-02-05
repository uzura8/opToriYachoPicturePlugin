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
    if ($isLink = sfConfig::get('app_tori_yacho_picture_is_enable_wiki_link'))
    {
      $linkUrl  = 'http://ja.wikipedia.org/wiki/';
      $linkUrl .= urlencode($this->toriName);
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

    return $toriList[$key];
  }
}
