<div class="site__footer">
  <div class="footer">
    <div class="row row--fullscreen collapse align-justify">
      <div class="small-12 medium-3 column">
        <div class="address">
          <p class="street"><?php the_field('footer_address', 'option')?></p>
          <p class="city"><?php the_field('footer_city', 'option')?></p>
          <p class="country"><?php the_field('footer_country', 'option')?></p>
        </div>
      </div>
      <div class="small-12 medium-3 column"></div>
      <div class="small-12 medium-4 column">
        <ul class="emails list">
          <li class="list-item email"><a href="mailto:"><?php the_field('footer_email_career', 'option')?></a></li>
          <li class="list-item email"><a href="mailto:"><?php the_field('footer_email_info', 'option')?></a></li>
        </ul>
        <ul class="social-media list">
          <li class="list-item">
            <a href="<?php the_field('footer_facebook', 'option')?>" target="_blank">
              <span class="icon">
                <svg>
                  <use xlink:href="../images/svg-sprite.svg#icon__facebook"></use>
                </svg>
              </span>
            </a>
          </li>
          <li class="list-item">
            <a href="<?php the_field('footer_linkedin', 'option')?>" target="_blank">
              <span class="icon">
                <svg>
                  <use xlink:href="../images/svg-sprite.svg#icon__linkedin"></use>
                </svg>
              </span>
            </a>
          </li>
          <li class="list-item">
            <a href="<?php the_field('footer_twitter', 'option')?>" target="_blank">
              <span class="icon">
                <svg>
                  <use xlink:href="../images/svg-sprite.svg#icon__twitter"></use>
                </svg>
              </span>
            </a>
          </li>
          <li class="list-item"><a href="<?php the_field('footer_instagram', 'option')?>" target="_blank">
            <span class="icon">
                <svg>
                  <use xlink:href="../images/svg-sprite.svg#icon__instagram"></use>
                </svg>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wipe">
  <div class="wipe__loading">
    <p class="wipe__loading__text">loading</p>
    <div class="wipe__loading__dash"></div>
  </div>
  <div class="wipe__background"></div>
</div>
