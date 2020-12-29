<?php
/*
Template Name: Шаблон главной страницы
Template Post Type: post, page, product
*/
?>

<?php get_header() ?>
<main class="main-content">
  <h1 class="sr-only"> Домашняя страница спортклуба SportIsland. </h1>
  <div class="banner">
    <span class="sr-only">Будь в форме!</span>
    <a href="<?= get_post_type_archive_link('services') ?>" class="banner__link btn">записаться</a>
  </div>

  <?php
  $about_post = get_post('107');
  if ($about_post):
    ?>
    <article class="about">
      <div class="wrapper about__flex">
        <div class="about__wrap">
          <h2 class="main-heading about__h"> <?= $about_post->post_title ?> </h2>
          <p class="about__text"><?= $about_post->post_excerpt ?></p>
          <a href="<?= get_the_permalink($about_post->ID) ?>" class="about__link btn">подробнее</a>
        </div>
        <figure class="about__thumb">
          <?= get_the_post_thumbnail($about_post->ID, 'full') ?>
        </figure>
      </div>
    </article>
  <?php endif;

  $sales = get_posts([
    'numberposts' => -1,
    'category_name' => 'sails',
    'meta_key' => 'sales_actual',
    'meta_value' => '1',
  ]);

  if ($sales):

    ?>

    <section class="sales">
      <div class="wrapper">
        <header class="sales__header">
          <h2 class="main-heading sales__h"> <?= get_cat_name(21); ?> </h2>
          <p class="sales__btns">
            <button class="sales__btn sales__btn_prev">
              <span class="sr-only"> Предыдущие акции </span>
            </button>
            <button class="sales__btn sales__btn_next">
              <span class="sr-only"> Следующие акции </span>
            </button>
          </p>
        </header>
        <div class="sales__slider slider">

          <?php
          global $post;
          foreach ($sales as $post):
            setup_postdata($post);
            ?>
            <section class="slider__slide stock">
              <a href="<?php the_permalink(); ?>" class="stock__link"
                 aria-label="Подробнее об акции скидка 20% на групповые занятия">
                <?php the_post_thumbnail('full', ['class' => 'stock__thumb']) ?>
                <h3 class="stock__h"> <?php the_title() ?> </h3>
                <p class="stock__text"> <?= get_the_excerpt(); ?></p>
                <span class="stock__more link-more_inverse link-more">Подробнее</span>
              </a>
            </section>
          <?php endforeach;
          wp_reset_postdata(); ?>
        </div>
      </div>
    </section>

  <?php endif; ?>


  <?php
  $query = new WP_Query([
    'numberposts' => -1,
    'post_type' => 'cards',
    'meta_key' => 'club_order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
  ]);
  $cards = $query->posts;

  if ($query->have_posts()):?>
    <section class="cards cards_index">
      <div class="wrapper">
        <h2 class="main-heading cards__h"> клубные карты </h2>
        <ul class="cards__list row">
          <?php while ($query->have_posts()): $query->the_post();?>

          <?php
            $profit_class ='';
            if(get_field('club_profit')) {
              $profit_class = 'card_profitable';
            }

            $benefits = get_field('club_benefits');
            $list = explode("\n", $benefits);

            ?>

          <li class="card <?=$profit_class?>">
            <h3 class="card__name"> <?php the_title(); ?> </h3>
            <p class="card__time"> <?php the_field('club_time_start') ?> &ndash; <?php the_field('club_time_end') ?> </p>
            <p class="card__price price"> <?php the_field('club_price') ?> <span class="price__unit" aria-label="рублей в месяц">р.-/мес.</span>
            </p>
            <ul class="card__features">
              <?php
                foreach ($list as $key=>$item)
                  echo "<li class=\"card__feature\">{$item}</li>";
              ?>
            </ul>
            <a data-post-id="99" href="#modal-form" class="card__buy btn btn_modal">купить</a>
          </li>
          <?php endwhile; wp_reset_postdata(); ?>

        </ul>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php get_footer() ?>
