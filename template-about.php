<?php
/**
 * Template Name: About
 */
?>

<div class="container">
  <div class="hero">
    <div class="row row--fullscreen collapse">
      <div class="hero__media">
        <div class="icon__buffle icon">
          <svg viewBox="0 0 120 20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <rect id="bar" fill="#FFFFFF" x="0" y="0" width="60" height="20"></rect>
              <animateTransform attributeName="transform" attributeType="XML" type="translate" values="0 0; 60 0; 0 0" dur="0.5s" fill="freeze" repeatCount="indefinite"></animateTransform>
            </g>
          </svg>
        </div>
        <?php
          $repeater_video = get_field( 'about_video' );
          $rand_video = rand(0, (count($repeater_video) - 1));
          echo "<video autoplay loop muted poster='' id='heroVideo'><source src= '".$repeater_video[$rand_video]['about_video_file']."' type='video/mp4'></video>"
        ?>
      </div>
      <div class="small-12 medium-6 column align-self-bottom">
        <div class="hero__content">
          <h1 class="statement"><?php the_field('about_introduction'); ?></h1>
        </div>
      </div>
      <div class="hero__hint">
        <p class="hero__hint__text"><?php the_field('about_hint'); ?></p>
        <div class="hero__hint__icon icon">
          <svg>
            <use xlink:href="../images/svg-sprite.svg#icon__scroll"></use>
          </svg>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container container--bg-01 container--double-padding">
  <div class="multi-col-slider">
    <div class="row">
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="list swiper-wrapper">
            <?php
            $images = get_field('about_clients_1');
            if( $images ): ?>
            <?php foreach( $images as $image ): ?>
            <li class="list__item swiper-slide">
          	<img src="<?php echo $image['url']?>" alt="">
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="list swiper-wrapper">
            <?php
            $images = get_field('about_clients_2');
            if( $images ): ?>
            <?php foreach( $images as $image ): ?>
            <li class="list__item swiper-slide">
          	<img src="<?php echo $image['url']?>" alt="">
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="list swiper-wrapper">
            <?php
            $images = get_field('about_clients_3');
            if( $images ): ?>
            <?php foreach( $images as $image ): ?>
            <li class="list__item swiper-slide">
          	<img src="<?php echo $image['url']?>" alt="">
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container container--double-padding">
  <div class="row">
    <?php if( have_rows('about_description') ): while( have_rows('about_description') ): the_row(); ?>
    <div class="small-12 medium-6 large-4 column">
      <div class="paragraph">
        <div class="paragraph__title">
          <h4 class="title black">Kilo</h4>
        </div>
        <div class="paragraph__content">
          <?php the_sub_field('about_description_company'); ?>
        </div>
      </div>
    </div>
    <div class="small-12 medium-6 large-4 column">
      <div class="paragraph">
        <div class="paragraph__title">
          <h4 class="title black">Clients</h4>
        </div>
        <div class="paragraph__content">
          <?php the_sub_field('about_description_clients'); ?>
        </div>
      </div>
    </div>
    <div class="small-12 medium-6 large-4 column">
      <div class="paragraph">
        <div class="paragraph__title">
          <h4 class="title black">Collaboration</h4>
        </div>
        <div class="paragraph__content">
          <?php the_sub_field('about_description_collaboration'); ?>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
<div class="container container--bg-02 container--double-padding">
  <div class="multi-col-slider">
    <div class="row">
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="list swiper-wrapper">
            <?php
            $images = get_field('about_awards_1');
            if( $images ): ?>
            <?php foreach( $images as $image ): ?>
            <li class="list__item swiper-slide">
          	<img src="<?php echo $image['url']?>" alt="">
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="list swiper-wrapper">
            <?php
            $images = get_field('about_awards_2');
            if( $images ): ?>
            <?php foreach( $images as $image ): ?>
            <li class="list__item swiper-slide">
          	<img src="<?php echo $image['url']?>" alt="">
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="list swiper-wrapper">
            <?php
            $images = get_field('about_awards_3');
            if( $images ): ?>
            <?php foreach( $images as $image ): ?>
            <li class="list__item swiper-slide">
          	<img src="<?php echo $image['url']?>" alt="">
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
