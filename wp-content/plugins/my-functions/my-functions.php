<?php
/*
Plugin Name: My Functions
Description: よく使う関数をまとめたプラグイン
Author: Bistro Calme
Version: 1.0.0
*/

class My_Functions
{
  public $test = 'test';
  private $private = 'private';

  function __construct()
  {
    add_shortcode('test', [$this, 'shortcode_test']);
  }
  function display_hello()
  {
    echo 'こんにちは' . $this->private;
  }
  function shortcode_test()
  {
    return '「ショートコードのテストです」';
  }
}

$my_functions = new My_Functions();
// メソッドの呼び出し方
// $my_functions->display_hello();
