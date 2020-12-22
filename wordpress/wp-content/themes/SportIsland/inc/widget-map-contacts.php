<?php

class SI_Widget_Map_Contacts extends WP_Widget
{
  public function __construct() //$id_base, $name, $widget_options = array(), $control_options = array()
  {
    parent::__construct(
      'si_widget_map_contacts',
      'SportIsland - Виджет контактов',
      [
        'name' => 'SportIsland - Виджет контактов',
        'description' => 'Выводит контакты под картой на странице контактов',
      ]);
  }

  public function form($instance)
  {
    $vars = [
      'map' => 'Карта',
      'clock' => 'Часы',
      'phone' => 'Телефон',
      'email' => 'Почта',
    ]

    ?>

    <p>
      <label for="<?= $this->get_field_id('id-info'); ?>">Информация:</label>
      <input
          id="<?= $this->get_field_id('id-info'); ?>"
          type="text"
          name="<?= $this->get_field_name('info') ?>"
          value="<?= $instance['info']; ?>"
          class="widefat"
      >
    </p>
    <p>
      <label for="<?= $this->get_field_id('id-var'); ?>">Выберите иконку:</label>
      <select
          id="<?= $this->get_field_id('id-var'); ?>"
          name="<?= $this->get_field_name('var') ?>"
          class="widefat"
      >
        <?php foreach ($vars as $key => $var): ?>
          <option
              value="<?= $key ?>"
            <?php selected($instance['var'], $key, true); ?>
          > <?= $var ?>  </option>
        <?php endforeach; ?>

      </select>
    </p>

    <?php

    //return parent::form($instance); // TODO: Change the autogenerated stub
  }

  public function widget($args, $instance)
  {
    switch ($instance['var']) {
      case 'map':
        ?>
        <span class="widget-address"><?= $instance['info'] ?></span>
        <?php
        break;
      case 'clock':
        ?>
        <span class="widget-working-time"><?= $instance['info'] ?></span>
        <?php
        break;
      case 'phone':
        $tel_text = $instance['info'];
        $pattern = '/[^+0-9]/';
        $tel = preg_replace($pattern, '', $tel_text);
        ?>
        <a href="tel:<?=$tel?>" class="widget-phone"><?= $instance['info'] ?></a>
        <?php
        break;
      case 'email':
        ?>
        <a href="mailto:<?= $instance['info'] ?>" class="widget-email"><?= $instance['info'] ?></a>
        <?php
        break;
      default:
        echo '';
        break;
    }
//    <span class="widget-address"> г. Москва, ул. Приречная 11 </span>
//    <span class="widget-working-time"> Работаем с 09:00 до 20:00 </span>
//    <a href="tel:88007003030" class="widget-phone"> 8 800 700 30 30 </a>
//    <a href="mailto:sportisland@gmail.ru" class="widget-email">sportisland@gmail.ru</a>


    echo $instance['text'];
    //parent::widget($args, $instance); // TODO: Change the autogenerated stub
  }

  public function update($new_instance, $old_instance)
  {
    return parent::update($new_instance, $old_instance); // TODO: Change the autogenerated stub
  }
}