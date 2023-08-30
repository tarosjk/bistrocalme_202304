<?php

// titleタグを出力する
add_theme_support('title-tag');
// アイキャッチ画像を有効化する
add_theme_support('post-thumbnails');

add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator()
{
  return '|';
}

// titleタグを変更する（TOPページのみ）
add_filter('document_title_parts', 'my_document_title_parts');
function my_document_title_parts($title)
{
  if (is_home()) {
    $title['title'] .= 'は、' . $title['tagline'] . 'です。';
    unset($title['tagline']);
  }

  return $title;
}

// ob_end_flushのNotice対策
remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function () {
  while (@ob_end_flush()); //@はエラーをミュートする演算子
});
