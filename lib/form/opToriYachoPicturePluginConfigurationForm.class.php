<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opToriYachoPicturePluginConfigurationForm
 *
 * @package    OpenPNE
 * @subpackage opToriYachoPicturePlugin
 * @author     uzura8 <<uzuranoie@gmail.com>
 */
class opToriYachoPicturePluginConfigurationForm extends BaseForm
{
  public function configure()
  {
    $choices = array('1' => 'Use', '0' => 'Not use');

    $this->setWidget('use_wiki_link', new sfWidgetFormSelectRadio(array('choices' => $choices)));
    $this->setValidator('use_wiki_link', new sfValidatorChoice(array('choices' => array_keys($choices))));
    $this->setDefault('use_wiki_link', Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_use_wiki_link', '1'));
    $this->widgetSchema->setLabel('use_wiki_link', 'wikipediaリンク使用設定');
    $this->widgetSchema->setHelp('use_wiki_link', '使用するに設定した場合、画像・野鳥名が wikipedia へのリンクになります。');

    $this->setWidget('use_safe_search_mode', new sfWidgetFormSelectRadio(array('choices' => $choices)));
    $this->setValidator('use_safe_search_mode', new sfValidatorChoice(array('choices' => array_keys($choices))));
    $this->setDefault('use_safe_search_mode', Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_use_safe_search_mode', '1'));
    $this->widgetSchema->setLabel('use_safe_search_mode', 'セーフサーチモード使用設定');
    $this->widgetSchema->setHelp('use_safe_search_mode', '使用するに設定した場合、セーフサーチモードが有効になります。');

    $this->setWidget('title', new sfWidgetFormInputText(array(), array('size' => 20)));
    $this->setValidator('title', new sfValidatorString(array('required' => true)));
    $this->setDefault('title', Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_title', '鳥写真'));
    $this->widgetSchema->setLabel('title', 'タイトル表示設定');
    $this->widgetSchema->setHelp('title', '表示タイトルを設定します。');

    $defaultSearchWordList = opToriYachoPicturePluginToolkit::getYachoNameList();
    $this->setWidget('search_word_list', new sfWidgetFormTextarea(array(), array('rows' => '20', 'cols' => '30')));
    $this->setValidator('search_word_list', new sfValidatorString(array('required' => true)));
    $this->setDefault('search_word_list', Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_search_word_list', $defaultSearchWordList));
    $this->widgetSchema->setLabel('search_word_list', '検索ワード設定');
    $help = '画像検索用のワードを入力してください。<br />※改行区切りで複数の検索ワードを入力することができます。';
//    $help .= '<br /><br /><h4>デフォルト検索ワード</h4>';
//    $help .= sprintf('<p>%s</P>', nl2br($defaultSearchWordList));
    $this->widgetSchema->setHelp('search_word_list', $help);

    $this->widgetSchema->setNameFormat('op_tori_yacho_picture_plugin[%s]');
  }

  public function save()
  {
    $names = array('use_wiki_link', 'use_safe_search_mode', 'title', 'search_word_list');

    foreach ($names as $name)
    {
      Doctrine::getTable('SnsConfig')->set('op_tori_yacho_picture_plugin_'.$name, $this->getValue($name));
    }
  }
}
