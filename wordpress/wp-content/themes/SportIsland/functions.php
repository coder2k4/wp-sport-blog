<?php

$widgets = [
  'widget-text.php',
  'widget-contacts.php',
  'widget-social.php',
  'widget-iframe.php',
  'widget-map-contacts.php',
];

foreach ($widgets as $w)
  require_once(__DIR__ . '/inc/' . $w);


add_action('after_setup_theme', 'si_setup');
add_action('wp_enqueue_scripts', 'si_scripts');

add_action('widgets_init', 'si_register'); // Хук инициализации виджетов

/* Disable WordPress Admin Bar for all users */
add_filter('show_admin_bar', '__return_false');

//Регистрируем шорткод
add_shortcode('si-paste-link', 'si_paste_link');
//Создаем фильтр, которы проходит регуляркой и заменяе все шоркоды в виджете
add_filter('si_widget_text', 'do_shortcode');
//Функция шорткода
function si_paste_link($atts)
{
  $params = shortcode_atts([
    'link' => '',
    'text' => '',
    'type' => 'link',
  ], $atts);

  $params['text'] = $params['text'] ? $params['text'] : $params['link'];

  if ($params['link']) {
    $protocol = '';
    switch ($params['type']) {

      case 'email':
        $protocol = 'mailto:';
        break;
      case 'phone':
        $params['link'] = preg_replace('/[^+0-9]/', '', $params['link']);
        $protocol = 'tel:';
        break;

      default:
        $protocol = '';
        return '';
    }

    $link = $protocol . $params['link'];
    $text = $params['text'];

    return "<a href=\"${link}\">${text}</a>";

  } else return '';
}


function si_setup()
{
  register_nav_menu('primary', 'Меню в шапке'); // Регистрация меню
  register_nav_menu('secondary', 'Меню в подвале');

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
  return get_template_directory_uri() . '/assets/' . $path;
}

function si_register()
{
  register_sidebar([
    'name' => "Контакты в шапке сайта",
    'id' => "si-header",
    'before_widget' => null,
    'after_widget' => null,
  ]);

  register_sidebar([
    'name' => "Контакты в подвале сайта",
    'id' => "si-footer",
    'before_widget' => null,
    'after_widget' => null,
  ]);

  register_sidebar([
    'name' => "Контакты в футере - Колонка №1",
    'id' => "si-footer-column-1",
    'before_widget' => null,
    'after_widget' => null,
  ]);

  register_sidebar([
    'name' => "Контакты в футере - Колонка №2",
    'id' => "si-footer-column-2",
    'before_widget' => null,
    'after_widget' => null,
  ]);

  register_sidebar([
    'name' => "Контакты в футере - Колонка №3",
    'id' => "si-footer-column-3",
    'before_widget' => null,
    'after_widget' => null,
  ]);


  register_sidebar([
    'name' => "Карта",
    'id' => "si-map",
    'before_widget' => null,
    'after_widget' => null,
  ]);

  register_sidebar([
    'name' => "Под картой",
    'id' => "si-after-map",
    'before_widget' => null,
    'after_widget' => null,
  ]);

  $reg_widgets = [
    'si_widget_text',
    'si_widget_contacts',
    'si_widget_social',
    'si_widget_iframe',
    'si_widget_map_contacts',
  ];

  foreach ($reg_widgets as $r_w)
    register_widget($r_w);

}