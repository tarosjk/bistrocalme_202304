<?php get_header() ?>

<h2 class="pageTitle">メニュー<span>MENU</span></h2>

<?php get_template_part('template-parts/breadcrumb') ?>

<?php
$kinds = get_terms([
  'taxonomy' => 'kind',
  'hide_empty' => false,
  'order' => 'DESC',
]);

?>

<?php if (!empty($kinds)) : ?>
  <div class="pageNav">
    <ul>
      <?php foreach ($kinds as $kind) : ?>
        <li>
          <a href="<?= get_term_link($kind) ?>">
            <?= $kind->name ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<main class="main">

  <?php foreach ($kinds as $kind) : ?>
    <section class="sec">
      <div class="container">
        <div class="sec_header">
          <h2 class="title title-jp"><?= $kind->name ?></h2>
          <span class="title title-en">
            <?= strtoupper($kind->slug) ?>
          </span>
        </div>
        <div class="row justify-content-center">
          <?php
          $args = [
            'post_type' => 'menu',
            'posts_per_page' => -1, //-1は全件
            'tax_query' => [
              'relation' => 'AND',
              [
                'taxonomy' => $kind->taxonomy,
                'field' => 'slug',
                'terms' => $kind->slug,
              ]
            ]
          ];

          $the_query = new WP_Query($args);
          ?>
          <?php if ($the_query->have_posts()) : ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
              <div class="col-md-3">
                <?php get_template_part('template-parts/loop', 'menu') ?>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          <?php endif ?>

        </div>
      </div>
    </section>
  <?php endforeach; ?>

</main>

<?php get_footer() ?>