<?php
include_parts(
  'YachoPictureListBox',
  'yachoPictureHomeList',
  array(
    'title' => Doctrine::getTable('SnsConfig')->get('op_tori_yacho_picture_plugin_title', '鳥写真'),
    'toriName' => $toriName,
    'imageUrl' => $imageUrl,
    'linkUrl' => $linkUrl,
    'imageWidth' => $imageWidth,
    'moreInfo' => 'yachoPicture/list'
  )
);

