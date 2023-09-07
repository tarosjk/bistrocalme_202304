<?php

add_action('after_setup_theme', 'my_theme_support');
function my_theme_support()
{
  // titleタグを出力する
  add_theme_support('title-tag');

  // アイキャッチ画像を有効化する
  add_theme_support('post-thumbnails');

  // カスタムメニュー機能を使用可能にする
  add_theme_support('menus');

  // エディタースタイルを有効化する
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');
}

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

// MW WP Formカスタマイズ
function my_error_message($error, $key, $rule)
{
  if ($key === 'fullname' && $rule === 'noempty') {
    return 'お名前が入力されておらぬぞ';
  }
  return $error;
}
add_filter('mwform_error_message_mw-wp-form-52', 'my_error_message', 10, 3);

// お問い合わせページで自動的にPが挿入されるのを防ぐ
add_action('pre_get_posts', function () {
  if (is_page('contact')) {
    remove_filter('the_content', 'wpautop');
  }
});

// コメント以外の入力欄を削除
add_filter('comment_form_default_fields', 'my_comment_form_default_fields');
function my_comment_form_default_fields($fields)
{
  // $fields['url'] = ''; 
  unset($fields['url']);
  unset($fields['author']);
  unset($fields['email']);
  unset($fields['cookies']);

  return $fields;
}

// TOPページの最新情報を情報を3件のみ取得する
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
  // 管理画面、メインクエリ以外は設定しない
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  // トップページの場合
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return;
  }
}

// ob_end_flushのNotice対策
remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function () {
  while (@ob_end_flush()); //@はエラーをミュートする演算子
});

// REST APIにメニューのカスタムフィールドの情報を含める
add_action('rest_api_init', 'api_register_fields');
function api_register_fields()
{
  register_rest_field('menu', 'custom_fields', [
    'get_callback' => 'get_custom_field',
    'update_callback' => null,
    'schema' => null,
  ]);
}

function get_custom_field()
{
  // return get_post_meta();
  return get_post_custom();
}


// ショートコード（テスト）
add_shortcode('test', 'shortcode_test');
function shortcode_test()
{
  return '「ショートコードのテストです」';
}

// ショートコード（りんご数）
// [apple color="red" num="5" origin="青森"]
// $attsの中身 ['color'=> 'red', 'num' => '5', 'origin' => '青森']
add_shortcode('apple', 'shortcode_apple');
function shortcode_apple($atts)
{
  $atts = shortcode_atts(
    [
      'color' => '赤',
      'num' => 0,
      'origin' => '青森',
    ],
    $atts,
    'apple'
  );
  return "<p>{$atts['origin']}産の、{$atts['color']}色のりんごが{$atts['num']}個あります。</p>";
}
