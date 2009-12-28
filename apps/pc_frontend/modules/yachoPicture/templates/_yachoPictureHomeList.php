<?php
include_parts(
  'YachoPictureListBox',
  'yachoPictureHomeList',
  array(
    'title' => '鳥写真',
    'toriName' => $toriName,
    'imageUrl' => $imageUrl,
    'linkUrl' => $linkUrl,
    'imageWidth' => $imageWidth,
    'wikiData' => $wikiData,
    'moreInfo' => 'yachoPicture/list'
  )
);

