<?php get_header() ?>
  <main class="main-content">
    <div class="wrapper">
      <ul class="breadcrumbs">
        <li class="breadcrumbs__item breadcrumbs__item_home">
          <a href="index.html" class="breadcrumbs__link">Главная</a>
        </li>
        <li class="breadcrumbs__item">
          <a href="blog.html" class="breadcrumbs__link">Блог</a>
        </li>
        <li class="breadcrumbs__item">
          <a href="category.html" class="breadcrumbs__link">Кардио</a>
        </li>
        <li class="breadcrumbs__item">
          <a href="single.html" class="breadcrumbs__link">Рельефный пресс</a>
        </li>
      </ul>
    </div>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="main-article wrapper">
        <header class="main-article__header">
          <?php the_post_thumbnail('full', ['class' => 'main-article__thumb']) ?>
          <h1 class="main-article__h"><?php the_title() ?></h1>
        </header>
        <?php the_content() ?>
        <footer class="main-article__footer">
          <time datetime="<?= get_the_date('Y-m-d'); ?>"><?= get_the_date('d F Y'); ?></time>
          <a href="#" class="main-article__like like" data-href="<?= esc_url(admin_url('admin-ajax.php')) ?>"
             data-id="<?= $id ?>">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px" viewBox="0 0 51.997 51.997"
                 style="enable-background:new 0 0 51.997 51.997;" xml:space="preserve">
              <style>
                  path {
                      fill: #666;
                  }
              </style>
              <path d="M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905
        c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478
        c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014
        C52.216,18.553,51.97,16.611,51.911,16.242z"/>
            </svg>
            <span class="like__text">Нравится</span>
            <span class="like__count">
              <?php
              $likes = get_post_meta($id, 'si-like', true);
              echo $likes ? $likes : '0';
              ?>
            </span>
          </a>


          <script type="text/javascript">
            window.addEventListener('load', function () {
              const $button = document.querySelector('.main-article__like')
              const url = $button.dataset.href
              const id = $button.dataset.id


              try {
                if (!localStorage.getItem('liked'))
                  localStorage.setItem('liked', '')
              } catch (e) {
                console.log(e.message)
              }

              /**
               * Функция проверяет, проставлен ли данной статье лайк или нет?
               * @param id
               * @returns {boolean}
               */
              function getLike(id) {
                let liked = false;
                try {
                  // Проверяем присутствие ID в строке
                  liked = localStorage.getItem('liked').split(',').includes(id)
                } catch (e) {
                  console.log(e.message)
                }
                return liked
              }

              let hasLike = getLike(id)
              if (hasLike) $button.classList.add('like_liked') // Добавляем класс если лайкнута кнопка.

              $button.addEventListener('click', function (e) {
                e.preventDefault();

                hasLike = getLike(id)

                //Формируем данные для отправки
                const data = new FormData()
                data.append('action', 'post-likes');
                const like = hasLike ? 'sub' : 'add'
                data.append('like', like)
                data.append('id', id)

                // Отправляем AJAX запрос
                const xhr = new XMLHttpRequest()
                xhr.open('POST', url)
                xhr.send(data)
                $button.disabled = true
                xhr.addEventListener('readystatechange', function () {
                  if (xhr.readyState !== 4) return
                  if (xhr.status === 200) {
                    $button.querySelector('.like__count').innerText = xhr.responseText
                    let localLikedData = localStorage.getItem('liked')
                    let newData = ''
                    if (hasLike) {
                      newData = localLikedData.split(',').filter(function (likeId) {
                        return likeId !== id
                      }).join(',')
                    } else
                    {
                      newData = localLikedData.split(',').filter(Number).concat(id).join(',')
                    }

                    localStorage.setItem('liked', newData)
                    $button.classList.toggle('like_liked')
                  } else {
                    console.log(xhr.statusText)
                  }
                  $button.disabled = false
                })
              })
            })
          </script>


        </footer>
      </article>
    <?php endwhile;
    endif; ?>
  </main>
<?php get_footer() ?>