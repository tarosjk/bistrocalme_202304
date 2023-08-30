<?php 
/*
固定ページのコンテンツを取得する方法
（ブロックエディタでコンテンツ部を作成しない場合）

ヘッダー

ページのスラッグを取得
$slug = $post->post_name;

コンテンツ
get_template_part('template-parts/page', $slug)

フッター
*/