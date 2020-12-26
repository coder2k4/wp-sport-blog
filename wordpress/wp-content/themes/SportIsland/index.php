<?php get_header() ?>

<?php if (is_home()): ?>
  <main class="main-content">
    <h1 class="sr-only">Страница категорий блога на сайте спорт-клуба SportIsland</h1>
    <div class="wrapper">
      <?php get_template_part('chunks/breadcrumbs') ?>
    </div>


    <?php if (have_posts()): ?>

      <section class="last-posts">
        <div class="wrapper">
          <h2 class="main-heading last-posts__h"> последние записи </h2>
          <ul class="posts-list">
            <?php while (have_posts()) :
              the_post();
              ?>
              <li class="last-post">
                <a href="<?php the_permalink(); ?>" class="last-post__link"
                   aria-label="Читать текст статьи: <?php the_title(); ?>">
                  <figure class="last-post__thumb">
                    <?php the_post_thumbnail('full', ["class" => "last-post__img"]) ?>
                    <!--<img src="img/blog__article_thmb1.jpg" alt="" class="last-post__img">-->
                  </figure>
                  <div class="last-post__wrap">
                    <h3 class="last-post__h"> <?php the_title(); ?> </h3>
                    <p class="last-post__text"> <?= get_the_excerpt() ?> </p>
                    <span class="last-post__more link-more">Подробнее</span>
                  </div>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
          <?php the_posts_pagination() ?>
        </div>
      </section>

    <?php else: ?>

      <?php get_template_part('chunks/no-posts') ?>

    <? endif; ?>


    <section class="categories">
      <div class="wrapper">
        <h2 class="categories__h main-heading"> категории </h2>
        <ul class="categories-list">

          <?php
          $categories = get_categories();
          if (!empty($categories)):
            foreach ($categories as $category): ?>

              <li class="category">
                <a href="<?=get_category_link($category->term_id)?>" class="category__link">
                  <img src="<?= _si_assets_path("img/blog__category_thmb1.jpg")?>" alt="<?= $category->name ?>" class="category__thumb">
                  <span class="category__name"><?= $category->name ?></span>
                </a>
              </li>

            <?php endforeach; endif; ?>
        </ul>
      </div>
    </section>
  </main>
<?php else: ?>

  <main class="main-content">
    <h1 class="sr-only">Страница категорий блога на сайте спорт-клуба SportIsland</h1>
    <div class="wrapper">
      <?php get_template_part('chunks/breadcrumbs') ?>
    </div>


    <?php if (have_posts()): ?>

      <section class="last-posts">
        <div class="wrapper">
          <h2 class="main-heading last-posts__h"> Страховочный шаблон </h2>
          <ul class="posts-list">
            <?php while (have_posts()) :
              the_post();
              ?>
              <li class="last-post">
                <a href="<?php the_permalink(); ?>" class="last-post__link"
                   aria-label="Читать текст статьи: <?php the_title(); ?>">
                  <figure class="last-post__thumb">
                    <?php the_post_thumbnail('full', ["class" => "last-post__img"]) ?>
                    <!--<img src="img/blog__article_thmb1.jpg" alt="" class="last-post__img">-->
                  </figure>
                  <div class="last-post__wrap">
                    <h3 class="last-post__h"> <?php the_title(); ?> </h3>
                    <p class="last-post__text"> <?= get_the_excerpt() ?> </p>
                    <span class="last-post__more link-more">Подробнее</span>
                  </div>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
          <?php the_posts_pagination() ?>
        </div>
      </section>

    <?php else: ?>

      <?php get_template_part('chunks/no-posts') ?>

    <? endif; ?>

  </main>

<?php endif ?>

<?php get_footer() ?>
