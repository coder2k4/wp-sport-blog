<?php

add_action('after_setup_theme', 'si_setup');
add_action('wp_enqueue_scripts', 'si_scripts');

function si_setup()
{
  register_nav_menu( 'primary', 'Меню в шапке' ); // Регистрация меню
  register_nav_menu( 'secondary', 'Меню в подвале' );

  add_theme_support('custom-logo');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

function si_scripts()
{
  wp_enqueue_script('si-js', _si_assets_path('/js/js.js'), [], '1.0', true);
  wp_enqueue_style('si-style', _si_assets_path('css/styles.css'), [], '1.0', 'all');
}

function _si_assets_path($path): string
{
  return get_template_directory_uri(). '/assets/' . $path;
}