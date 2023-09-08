<article id="post-<?php the_ID() ?>" <?php post_class('news') ?>>
  <div class="news_pic">
    <a href="<?php the_permalink() ?>">
      <?php display_thumbnail() ?>
    </a>
  </div>
  <div class="news_meta">
    <?php the_category() ?>
    <time class="news_time" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('Y年m月d日') ?></time>
  </div>
  <h2 class="news_title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
  <div class="news_desc">
    <?php the_excerpt() ?>
    <p><a href="<?php the_permalink() ?>">[続きを読む]</a></p>
  </div>
</article>