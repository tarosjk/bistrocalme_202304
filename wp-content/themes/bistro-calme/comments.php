<section class="comments">
  <?php
  $args = [
    'title_reply' => 'コメント投稿フォーム',
  ];
  comment_form($args);
  ?>
  <p><?php comments_number('コメントを投稿してみませんか？', 'コメントが1件あります', 'コメントが%件あります') ?></p>
  <?php if (have_comments()) : ?>
    <ol class="commentlist">
      <?php
      $args = [
        'avatar_size' => 50,
        'format' => 'html5',
      ];
      wp_list_comments($args);
      ?>
    </ol>
    <?php
    $args = [
      'prev_text' => '←前のコメントページ',
      'next_text' => '次のコメントページ→',
    ];
    paginate_comments_links($args);
    ?>
  <?php endif; ?>
</section>