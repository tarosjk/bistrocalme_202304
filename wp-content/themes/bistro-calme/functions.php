<?php

// 別ファイルのロード
get_template_part('includes/mw_wp_form');

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

// HTML共通化ショートコード
add_shortcode('price', 'shortcode_price');
function shortcode_price($atts, $content = null)
{
  return "<div class=\"wrap\"><em>価格</em>: {$content}</div>";
}

// URLを出力するショートコード
add_shortcode('dir_url', 'shortcode_url_img');
function shortcode_url_img()
{
  return get_template_directory_uri() . '/assets/img/';
}


/**
 * サムネイル（アイキャッチ画像）を出力する関数
 * 
 * アイキャッチ画像が存在しているとそれを出力し、無い場合はNo image 画像を出力する
 * @param string|array $test 引数の説明
 */
function display_thumbnail()
{
  if (has_post_thumbnail()) {
    the_post_thumbnail();
  } else {
    $img_url = get_template_directory_uri();
    echo "<img src=\"{$img_url}/assets/img/common/noimage_600x400.png\" alt=\"\">";
  }
}

/**
 * メニュー画像の取得を行う
 * 
 * ACFで作成したメニューの画像を取得する
 * 
 * @param string $size 画像のサイズをキーワードで指定。'thumbnail','medium','large','full'など。
 */
function display_image($size = 'large')
{
  $pic = get_field('pic');
  if (!empty($pic)) {
    $pic_url = $pic['sizes'][$size];
    echo "<img src=\"{$pic_url}\" alt=\"\">";
  }
}
