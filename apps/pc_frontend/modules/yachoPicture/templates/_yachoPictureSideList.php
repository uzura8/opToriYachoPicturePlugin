<?php
include_parts(
  'YachoPictureListBox',
  'yachoPictureSideList',
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

