<?php

class SI_Widget_Iframe extends WP_Widget
{
  public function __construct() //$id_base, $name, $widget_options = array(), $control_options = array()
  {
    parent::__construct(
      'si_widget_iframe',
      'SportIsland - Html Iframe',
      [
        'name' => 'SportIsland - Html Iframe',
        'description' => 'Для вставки IFRAME и HTML'
      ]);
  }

  public function form($instance)
  {
    ?>

    <p>
      <label for="<?=$this->get_field_id('id-code');?>">Вставьте код:</label>
      <textarea
        id="<?=$this->get_field_id('id-code');?>"
        type="text"
        name="<?=$this->get_field_name('code')?>"
        value="<?=esc_html($instance['code']);?>"
        class="widefat"
      >
        <?=esc_html($instance['code'])?>

      </textarea>
    </p>

    <?php

    //return parent::form($instance); // TODO: Change the autogenerated stub
  }

  public function widget($args, $instance)
  {
    echo $instance['code'];
    //parent::widget($args, $instance); // TODO: Change the autogenerated stub
  }

  public function update($new_instance, $old_instance)
  {
    return parent::update($new_instance, $old_instance); // TODO: Change the autogenerated stub
  }
}