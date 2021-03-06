<div class="site__navigation">
  <div class="navigation">
    <span class="dash navigation__dash"></span>
    <div class="row row--fullscreen align-justify align-top medium-collapse">
      <div class="small-6 column shrink">
        <div class="logo">
          <a href="<?= esc_url(home_url('/')); ?>">
            <div class="icon">
              <svg viewbox="0 0 54 30" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.02000976,29.784285 L7.02000976,20.6744754 L13.4612006,29.784285 L32.6686188,29.784285 L32.6686188,23.7920937 C34.3777452,27.4563202 38.0956564,30 42.4080039,30 C48.3387018,30 53.1488531,25.1908248 53.1488531,19.2552465 C53.1488531,13.3235725 48.3387018,8.51732552 42.4080039,8.51732552 C38.0956564,8.51732552 34.3777452,11.057101 32.6686188,14.7223036 L32.6686188,0 L19.6290874,0 L19.6290874,7.02098585 L25.6486091,7.02098585 L25.6486091,8.72718399 L13.4612006,8.72718399 L7.02000976,17.838165 L7.02000976,0 L0,0 L0,29.784285 L7.02000976,29.784285 Z M42.4080039,15.4036115 C44.5358712,15.4036115 46.261591,17.1293314 46.261591,19.2552465 C46.261591,21.386042 44.5358712,23.1117618 42.4080039,23.1117618 C40.2801367,23.1117618 38.5553929,21.386042 38.5553929,19.2552465 C38.5553929,17.1293314 40.2801367,15.4036115 42.4080039,15.4036115 L42.4080039,15.4036115 Z M19.6290874,11.3469985 L19.6290874,27.1664226 L14.0409956,19.2552465 L19.6290874,11.3469985 Z"></path>
              </svg>
            </div>
          </a>
        </div>
      </div>
      <div class="small-6 column shrink">
        <?php
        if (has_nav_menu('primary_navigation')) :
          // wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'list menu__list', 'container_class' => 'menu', 'items_class' => 'list__item menu__list__item projects']);
          wp_nav_menu(['theme_location' => 'primary_navigation', 'container_class' => 'menu', 'menu_class' => 'list menu__list', 'walker' => new Custom_Walker() ]);
        endif;
        ?>
      </div>
    </div>
  </div>
</div>
