<section class="menu menu-border">
  <?php if (block_value('url')) : ?>
    <a href="#">
    <?php endif; ?>

    <figure>
      <img src="<?php block_field('pic') ?>" alt="">
    </figure>
    <h3 class="menu_title">
      <?php block_field('name') ?>
    </h3>
    <p class="menu_price"><?php block_field('price') ?>円</p>
    <div class="menu_desc">
      <?php block_field('desc') ?>
    </div>
    <?php if (block_value('url')) : ?>
    </a>
  <?php endif; ?>
</section>