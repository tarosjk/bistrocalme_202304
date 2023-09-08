<?php
/*
Plugin Name: Search Word Highlight
Description: 検索したワードをハイライトするプラグイン
Author: Bistro Calme
Version: 1.0.0
*/

class Search_Word_Highlight
{
  function __construct()
  {
    add_filter('the_title', [$this, 'highlight_text']);
    add_filter('the_content', [$this, 'highlight_text']);
    add_filter('the_excerpt', [$this, 'highlight_text']);
  }

  function highlight_text($text)
  {
    if (is_search()) {
      $string = get_query_var('s');
      $text = preg_replace("/{$string}/", "<span class=\"highlight\">{$string}</span>", $text);
    }
    return $text;
  }
}

$search_word_highlight = new Search_Word_Highlight();
