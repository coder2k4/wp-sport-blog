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


add_action('after_setup_theme', 'si_setup'); // Активируем скрытые настройки темы
add_action('wp_enqueue_scripts', 'si_scripts'); // Подгружаем наши скрипты
add_action('widgets_init', 'si_register'); // Хук инициализации виджетов
add_action('init', 'si_register_types'); // Регистрируем новые типы записей
add_action('add_meta_boxes', 'si_meta_boxes'); // Добавляем дополнительные поля для записи
add_action('save_post', 'si_save_like_meta'); // Подписываемся на хук сохранения постов в админке, для сохранения данных своего поля
add_action('admin_menu', 'si_general_option_slogan_register'); // Добавляем дополнительное поле, в настройки админ пенли

add_action('admin_post_nopriv_si-modal-form', 'si_modal_form_handler'); // Подписываемся на обработку (формы)
add_action('admin_post_si-modal-form', 'si_modal_form_handler'); // Подписываемся на обработку (формы)

add_action('admin_ajax_nopriv_post-likes', 'si_likes'); // Подписываемся на обработку (формы) AJAX admin_ajax_nopriv
add_action('admin_ajax_post-likes', 'si_likes'); // Подписываемся на обработку (формы) AJAX admin_ajax


add_shortcode('si-paste-link', 'si_paste_link'); //Регистрируем шорткод

add_filter('show_admin_bar', '__return_false'); // Отключаем панель администрирования
add_filter('si_widget_text', 'do_shortcode'); //Создаем фильтр, которы проходит регуляркой и заменяе все шоркоды в виджете

//Получение данных с формы
function si_modal_form_handler() {

}

function si_likes() {

  echo 'Данные получены';
  wp_die();

}

// Инициализируем новое поле и регистрируем его в админ панели
function si_general_option_slogan_register()
{

  // регистрируем опцию
  register_setting('general', 'si_general_option_slogan');

  // добавляем поле
  add_settings_field(
    'si_general_option_slogan',
    'Слоган вашего сайта',
    'si_general_option_slogan_cb',
    'general',
    'default',
    [
      'label_for' => 'si_general_option_slogan',
    ]
  );

}

function si_general_option_slogan_cb($args)
{
  ?>
  <input type="text" id="<?= $args['label_for'] ?>"
         value="<?= get_option($args['label_for']) ?>"
         name="<?= $args['label_for'] ?>"
         class="regular-text code"
  >
  <?php
}


// Сохраняем данные из дополнительного поля записи
function si_save_like_meta($post_id)
{
  if (isset($_POST['si-like'])) {
    update_post_meta($post_id, 'si-like', $_POST['si-like']);
  }
}


// Регистрируем дополнительное поле
function si_meta_boxes()
{
  add_meta_box(
    'si-like',
    'Количество лайков:',
    'si_meta_like_cb',
    'post'
  );
}

// Callback функция отвечающая за верстку дополнительного поля
function si_meta_like_cb($post_obj)
{
  $like = get_post_meta($post_obj->ID, 'si-like', 'true');
  $like = $like ? $like : '0';

  echo "<input type='text' name='si-like' value='${like}'>";


  //echo '<p>' . $like . '</p>';
}


// Регистрируем новые типы записей
function si_register_types()
{

  register_post_type('services', [
    'labels' => [
      'name' => 'Услуги', // основное название для типа записи
      'singular_name' => 'Услуга', // название для одной записи этого типа
      'add_new' => 'Добавить новую услугу', // для добавления новой записи
      'add_new_item' => 'Добавить новую услугу', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать услугу', // для редактирования типа записи
      'new_item' => 'Новая услуга', // текст новой записи
      'view_item' => 'Смотреть услуги', // для просмотра записи этого типа.
      'search_items' => 'Искать услуги', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Услуги', // название меню
    ],
    'public' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-smiley',
    'hierarchical' => false,
    'supports' => ['title'],
    'has_archive' => true,
  ]);

  register_post_type('trainers', [
    'labels' => [
      'name' => 'Тренеры', // основное название для типа записи
      'singular_name' => 'Тренер', // название для одной записи этого типа
      'add_new' => 'Добавить нового тренера', // для добавления новой записи
      'add_new_item' => 'Добавить нового тренера', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать тренера', // для редактирования типа записи
      'new_item' => 'Новый тренер', // текст новой записи
      'view_item' => 'Смотреть тренера', // для просмотра записи этого типа.
      'search_items' => 'Искать тренера', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Тренеры', // название меню
    ],
    'public' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-groups',
    'hierarchical' => false,
    'supports' => ['title'],
    'has_archive' => true,
  ]);

  register_post_type('schedule', [
    'labels' => [
      'name' => 'Занятия', // основное название для типа записи
      'singular_name' => 'Занятие', // название для одной записи этого типа
      'add_new' => 'Добавить новоe занятие', // для добавления новой записи
      'add_new_item' => 'Добавить новоe занятие', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать занятие', // для редактирования типа записи
      'new_item' => 'Новое занятие', // текст новой записи
      'view_item' => 'Смотреть занятие', // для просмотра записи этого типа.
      'search_items' => 'Искать занятие', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Занятия', // название меню
    ],
    'public' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-universal-access-alt',
    'hierarchical' => false,
    'supports' => ['title'],
    'has_archive' => true,
  ]);

  register_post_type('prices', [
    'labels' => [
      'name' => 'Прайс', // основное название для типа записи
      'singular_name' => 'Прайс', // название для одной записи этого типа
      'add_new' => 'Добавить новый прайс', // для добавления новой записи
      'add_new_item' => 'Добавить новый прайс', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать прайс', // для редактирования типа записи
      'new_item' => 'Новый прайс', // текст новой записи
      'view_item' => 'Смотреть прайс', // для просмотра записи этого типа.
      'search_items' => 'Искать прайс', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Прайсы', // название меню
    ],
    'public' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-money-alt',
    'hierarchical' => false,
    'supports' => ['title'],
    'has_archive' => true,
  ]);

  register_post_type('cards', [
    'labels' => [
      'name' => 'Карты', // основное название для типа записи
      'singular_name' => 'Карты', // название для одной записи этого типа
      'add_new' => 'Добавить новую карту', // для добавления новой записи
      'add_new_item' => 'Добавить новую карту', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать карту', // для редактирования типа записи
      'new_item' => 'Новая карта', // текст новой записи
      'view_item' => 'Смотреть карту', // для просмотра записи этого типа.
      'search_items' => 'Искать карту', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Клубные карты', // название меню
    ],
    'public' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-tickets-alt',
    'hierarchical' => false,
    'supports' => ['title'],
    'has_archive' => false,
  ]);


  // Регистрация таксономии

  register_taxonomy('schedule_days', ['schedule'], [
    'labels' => [
      'name' => 'Дни недели',
      'singular_name' => 'День',
      'search_items' => 'Найти день недели',
      'all_items' => 'Все дни недели',
      'view_item ' => 'Посмотреть дни недели',
      'edit_item' => 'Редактировать дни недели',
      'update_item' => 'Обновить',
      'add_new_item' => 'Добавить день недели',
      'new_item_name' => 'Добавить день недели',
      'menu_name' => 'Все дни недели',
    ],
    'description' => '',
    'public' => true,
    'hierarchical' => true,
  ]);

  register_taxonomy('places', ['schedule'], [
    'labels' => [
      'name' => 'Залы',
      'singular_name' => 'Залы',
      'search_items' => 'Найти залы',
      'all_items' => 'Все залы',
      'view_item ' => 'Посмотреть зал',
      'edit_item' => 'Редактировать зал',
      'update_item' => 'Обновить',
      'add_new_item' => 'Добавить зал',
      'new_item_name' => 'Добавить зал',
      'menu_name' => 'Все залы',
    ],
    'description' => '',
    'public' => true,
    'hierarchical' => true,
  ]);


}


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