<?php
/**
* Template Name: News
*/
?>

<?php
$args = array(
  'numberposts'   => -1,
	'post_type'     => array( 'news' )
);
$query = new WP_Query( $args );
?>

<div class="collection collection--news">
  <div class="news">
    <?php if( $query->have_posts() ): ?>
    <?php while( $query->have_posts() ) : $query->the_post();
      $image_src = get_field('news_thumbnail');
      $image_size = 'img-large';
      $image = wp_get_attachment_image_src( $image_src, $image_size );
      $image_srcset = wp_get_attachment_image_srcset( $image_src, $image_size );
    ?>
    <div class="row row--fullscreen collapse align-center">
      <div class="thumbnail thumbnail--news">
        <a href="<?php the_permalink(); ?>">
          <div class="small-12 medium-6 column">
            <div class="thumbnail--news__content"><span class="dash"></span>
              <h3 class="title bold"><?php the_title(); ?></h3>
              <p class="meta"><?php the_time('F n, Y') ?></p>
              <p class="teaser"><?php the_field('news_excerpt'); ?></p>
            </div>
          </div>
          <div class="small-12 medium-6 column">
            <div class="thumbnail--news__media">
              <?php echo wp_get_attachment_image( $image_src, $image_size ); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>
