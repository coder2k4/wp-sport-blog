<div class="modal">
  <div class="wrapper">
    <section class="modal-content modal-form" id="modal-form">
      <button class="modal__closer">
        <span class="sr-only">Закрыть</span>
      </button>
      <form
          method="post"
          action="<?= esc_url(admin_url('admin-post.php')); ?>"
          class="modal-form__form">
        <h2 class="modal-content__h"> Отправить заявку </h2>
        <p> Оставьте свои контакты и менеджер с Вами свяжется </p>
        <p>
          <label>
            <span class="sr-only">Имя: </span>
            <input type="text" name="si-user-name" placeholder="Имя">
          </label>
        </p>
        <p>
          <label>
            <span class="sr-only">Телефон:</span>
            <input type="text" name="si-user-phone" placeholder="Телефон" pattern="^\+{0,1}[0-9]{4,}$" required>
          </label>
        </p>
        <input type="hidden" name="action" value="si-modal-form">
        <button class="btn" type="submit">Отправить</button>
      </form>
    </section>
  </div>
</div>
<div class="footer">
  <header class="main-header">
    <div class="wrapper main-header__wrap">
      <a href="index.html" class="main-header__logolink" aria-label="Логотип-ссылка на Главную">
        <img src="img/logo.png" alt="">

      </a>

      <p class="main-header__logolink">
        <?php the_custom_logo() ?>
        <span class="slogan"><?= get_option('si_general_option_slogan') ?></span>
      </p>
      <!--      <nav class="main-navigation">-->
      <!--        <ul class="main-navigation__list">-->
      <!--         -->
      <!--          <li class="active">-->
      <!--            <a href="trainers.html">Тренеры</a>-->
      <!--          </li>-->
      <!--          <li>-->
      <!--            <a href="schedule.html">Расписание</a>-->
      <!--          </li>-->
      <!--          <li>-->
      <!--            <a href="prices.html">Цены</a>-->
      <!--          </li>-->
      <!--          <li>-->
      <!--            <a href="contacts.html">Контакты </a>-->
      <!--          </li>-->
      <!--        </ul>-->
      <!--      </nav>-->
      <nav class="main-navigation">
        <ul class="main-navigation__list">
          <?php
          $location = get_nav_menu_locations();
          $menu_id = $location['secondary'];
          $menu_items = wp_get_nav_menu_items($menu_id, ['order' => 'ASC', 'orderby' => 'menu_order']);

          $http_s = 'http' . ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off' ? 's' : '') . '://';
          $url = $http_s . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

          foreach ($menu_items as $item):
            ?>
            <li class="<?= $item->url == $url ? 'active' : '' ?>">
              <a href="<?= $item->url ?>"><?= $item->title ?></a>
            </li>
          <?php endforeach; ?>

        </ul>
      </nav>
      <?php
        if(is_active_sidebar('si-footer'))
          dynamic_sidebar('si-footer')
      ?>
    </div>
  </header>
  <footer class="main-footer wrapper">
    <div class="row main-footer__row">
      <div class="main-footer__widget main-footer__widget_copyright">
        <span class="widget-text">
          <?php
          if(is_active_sidebar('si-footer-column-1'))
            dynamic_sidebar('si-footer-column-1')
          ?>
        </span>
      </div>
      <div class="main-footer__widget">
        <p class="widget-contact-mail">
          <?php
          if(is_active_sidebar('si-footer-column-2'))
            dynamic_sidebar('si-footer-column-2')
          ?>
        </p>
      </div>
      <div class="main-footer__widget main-footer__widget_social">
        <?php
        if(is_active_sidebar('si-footer-column-3'))
          dynamic_sidebar('si-footer-column-3')
        ?>
      </div>
    </div>
  </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>