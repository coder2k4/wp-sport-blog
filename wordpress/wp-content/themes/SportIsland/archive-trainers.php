<?php get_header() ?>


<main class="main-content">
  <div class="wrapper">
    <?php get_template_part('chunks/breadcrumbs'); ?>
  </div>
  <section class="trainers">
    <div class="wrapper">
      <h1 class="main-heading trainers__h">Тренеры</h1>
      <?php if (have_posts()) : ?>
      <ul class="trainers-list">

        <?php while (have_posts()) : the_post();  ?>
        <li class="trainers-list__item">
          <article class="trainer">
            <img src="<?= get_field('trainer_photo')['url']?>" alt="<?= get_field('trainer_photo')['alt']?>" class="trainer__thumb">
            <div class="trainer__wrap">
              <h2 class="trainer__name"> <? the_title(); ?> </h2>
              <p class="trainer__text"> <? the_field('trainer_description'); ?> </p>
            </div>
            <a href="#" class="trainer__subscribe btn">записаться</a>
          </article>
        </li>
        <?php endwhile; ?>

      </ul>
      <?php the_posts_pagination(); ?>

      <?php else: ?>
        <?php get_template_part('chunks/no-posts'); ?>
      <?php endif; ?>
    </div>
  </section>
</main>


<?php get_footer() ?>