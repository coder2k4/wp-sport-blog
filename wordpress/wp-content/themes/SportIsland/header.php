<!DOCTYPE html>
<html <?php get_language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv='X-UA-Compatible' content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,800,900&display=swap&subset=cyrillic"
        rel="preload stylesheet">
  <?php wp_head() ?>
</head>
<body class="<?= !is_front_page() ? 'inner' : '' ?>">
<header class="main-header">
  <div class="wrapper main-header__wrap">
    <?php the_custom_logo() ?>
<!--    <nav class="main-navigation">-->
<!--      <ul class="main-navigation__list">-->
<!--        <li>-->
<!--          <a href="services.html">Услуги</a>-->
<!--        </li>-->
<!--        <li class="active">-->
<!--          <a href="trainers.html">Тренеры</a>-->
<!--        </li>-->
<!--        <li>-->
<!--          <a href="schedule.html">Расписание</a>-->
<!--        </li>-->
<!--        <li>-->
<!--          <a href="prices.html">Цены</a>-->
<!--        </li>-->
<!--        <li>-->
<!--          <a href="contacts.html">Контакты </a>-->
<!--        </li>-->
<!--      </ul>-->
<!--    </nav>-->

    <?php wp_nav_menu([
      'theme_location'  => 'primary',
      'container'       => 'nav',
      'container_class' => 'main-navigation',
      'menu_class'      => 'main-navigation__list',
      'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
    ]) ?>


    <address class="main-header__widget widget-contacts">
      <a href="tel:88007003030" class="widget-contacts__phone"> 8 800 700 30 30 </a>
      <p class="widget-contacts__address"> ул. Приречная 11 </p>
    </address>
    <button class="main-header__mobile">
      <span class="sr-only">Открыть мобильное меню</span>
    </button>
  </div>
</header>


