<?php while (have_posts()) : the_post();
  $image_src = get_field('work_thumbnail');
  $image_size = 'img-xxlarge';
  $image = wp_get_attachment_image_src( $image_src, $image_size );
  $image_srcset = wp_get_attachment_image_srcset( $image_src, $image_size );
  $project_color = get_field('work_color');
?>
<div class="container">
  <div style="background-color: <?php echo $project_color ?>" class="hero--project">
    <div class="hero--project__media">
      <?php echo wp_get_attachment_image( $image_src, $image_size ); ?>
      <!-- TODO: Need to compile vanilla-lazyload into the js build in order for srcset lazyload to work -->
      <!-- <img data-srcset="<?php echo esc_attr( $image_srcset ); ?>" data-src="<?php echo $image[0]; ?>" alt="TODO: Replace with alt"> -->
    </div>
    <div class="hero--project__content">
      <h1 class="title"><?php the_title(); ?></h1>
      <div class="usp">
        <p><?php the_field('work_excerpt'); ?></p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div style="background-color: <?php echo $project_color ?>" class="section project__section project__section--sideQuote">
    <div class="row row--fullscreen collapse">
      <div class="small-12 medium-6 large-6 column left">
        <div class="section__description">
          <h3 class="title bold"><?php the_field('work_heading'); ?></h3>
          <?php the_field('work_description'); ?>
        </div>
      </div>
      <div class="small-12 medium-6 large-6 column right">
        <?php if( get_field('work_additional') == '1' ): ?>
          <div class="section__quote">
            <blockquote style="color: <?php echo $project_color ?>">
              <p><?php the_field('work_quote'); ?></p>
              <div style="background-color: <?php echo $project_color ?>" class="dash"></div>
              <footer>
                <p style="color: <?php echo $project_color ?>"><?php the_field('work_quoteauthor'); ?></p>
              </footer>
            </blockquote>
          </div>
        <?php elseif( get_field('work_additional') == '2' ): ?>
          <div class="section__media">
            <img src="<?php the_field('work_additionalimage'); ?>">
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="project__meta-info">
    <div class="row row--fullscreen collapse">
      <div class="small-12 medium-4 column">
        <ul title="Info" class="list meta-info">
          <li class="list-item meta">
            <span class="meta__label">Client</span> - <span class="meta__value"><?php the_field('work_client'); ?></span>
          </li>
          <li class="list-item meta">
            <span class="meta__label">Year</span> - <span class="meta__value"><?php the_field('work_year'); ?></span>
          </li>
          <li class="list-item meta">
            <span class="meta__label">Status</span> - <span class="meta__value"><?php the_field('work_status'); ?></span>
          </li>
        </ul>
      </div>
      <div class="small-12 medium-4 column">
        <!-- TODO: Recognitions could be a selection of awards. Each would print recognition title and nice svg logo -->
        <ul title="Recongnitions" class="list recongnitions">
          <?php
          if( have_rows('work_recognitiontitle') ):
            while ( have_rows('work_recognitiontitle') ) : the_row(); ?>
            <li class="list-item meta">
              <span class="meta__value"><?php the_sub_field('work_recognitiontitle_text'); ?></span>
            </li>
          <?php endwhile;
          else :
            // do stuff
          endif;
          ?>
        </ul>
      </div>
      <div class="small-12 medium-4 column">
        <div class="swiper-container">
          <ul class="swiper-wrapper">
            <?php
            if( have_rows('work_recognitionlogo') ):
              while ( have_rows('work_recognitionlogo') ) : the_row(); ?>
              <li class="list__item swiper-slide">
                <img src="<?php the_sub_field('work_recognitionlogo_img'); ?>" class="list__item__img">
              </li>
            <?php endwhile;
            else :
              // do stuff
            endif;
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>
