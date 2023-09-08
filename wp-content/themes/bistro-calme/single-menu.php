<?php get_header() ?>

<h2 class="pageTitle">メニュー<span>MENU</span></h2>

<?php get_template_part('template-parts/breadcrumb') ?>

<img src="<?= do_shortcode('[dir_url]'); ?>common/logo.png" alt="">

<p>
  <?php $my_functions->display_hello(); ?>
</p>

<p>
  <?= do_shortcode('[test]'); ?>
</p>

<main class="main">
  <section class="sec">
    <div class="container">
      <div class="article article-menu">
        <div class="row">
          <div class="col-12 col-md-6">
            <h2 class="article_title"><?php the_title() ?></h2>
            <div class="content">
              <?php the_content() ?>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="article_pic">
              <?php display_image(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="info">
      <div class="container">
        <ul class="info_list">
          <li>
            <b>価格</b>
            <span><?php the_field('price') ?>円</span>
          </li>
          <li>
            <b>カロリー</b>
            <span><?= number_format(get_field('calorie')) ?> kcal</span>
          </li>
          <li>
            <b>アレルギー</b>
            <span>
              <?php
              $allegies = get_field('allegies');
              echo implode('、', $allegies);
              ?>
            </span>
          </li>
          <li>
            <b>予約</b>
            <span>
              <?= get_field('reservation') ? '必要あり' : '必要なし'  ?>
            </span>
          </li>
        </ul>
      </div>
    </div>
  </section>


  <section class="sec">
    <div class="container">
      <div class="sec_header">
        <h2 class="title title-jp">その他のフード</h2>
        <span class="title title-en">FOOD</span>
      </div>
      <div class="row justify-content-center">

        <div class="col-md-3">
          <section class="menu">
            <a href="#">
              <figure class="menu_pic">
                <img src="./assets/img/menu/menu-1@2x.jpg" alt="">
              </figure>
              <h3 class="menu_title">メニュー名が入ります</h3>
              <p class="menu_price">800円</p>
              <div class="menu_desc">
                <p>
                  概要が入ります。概要が入ります。概要が入ります。概要が入ります。
                </p>
              </div>
            </a>
          </section>
        </div>

        <div class="col-md-3">
          <section class="menu">
            <a href="#">
              <figure class="menu_pic">
                <img src="./assets/img/menu/menu-2@2x.jpg" alt="">
              </figure>
              <h3 class="menu_title">メニュー名が入ります</h3>
              <p class="menu_price">800円</p>
              <div class="menu_desc">
                <p>
                  概要が入ります。概要が入ります。概要が入ります。概要が入ります。
                </p>
              </div>
            </a>
          </section>
        </div>

        <div class="col-md-3">
          <section class="menu">
            <a href="#">
              <figure class="menu_pic">
                <img src="./assets/img/menu/menu-3@2x.jpg" alt="">
              </figure>
              <h3 class="menu_title">メニュー名が入ります</h3>
              <p class="menu_price">800円</p>
              <div class="menu_desc">
                <p>
                  概要が入ります。概要が入ります。概要が入ります。概要が入ります。
                </p>
              </div>
            </a>
          </section>
        </div>

        <div class="col-md-3">
          <section class="menu">
            <a href="#">
              <figure class="menu_pic">
                <img src="./assets/img/menu/menu-4@2x.jpg" alt="">
              </figure>
              <h3 class="menu_title">メニュー名が入ります</h3>
              <p class="menu_price">800円</p>
              <div class="menu_desc">
                <p>
                  概要が入ります。概要が入ります。概要が入ります。概要が入ります。
                </p>
              </div>
            </a>
          </section>
        </div>

        <div class="col-12">
          <div class="sec_btn">
            <a href="" class="btn btn-default">メニュー一覧<i class="fas fa-angle-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<?php get_footer() ?>