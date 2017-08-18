<?php
/**
 * Template Name: Work
 */
?>

<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'numberposts'   => 1,
	'post_type'     => array( 'work' ),
  'posts_per_page' => 1,
  'paged'          => $paged
);
$query = new WP_Query( $args );
?>

<div class="container">
  <div class="collection collection--projects">
    <div class="projects">
      <?php if( $query->have_posts() ): ?>
    	<?php while( $query->have_posts() ) : $query->the_post();
        $image_src = get_field('work_thumbnail');
        $image_size = 'img-xxlarge';
        $image = wp_get_attachment_image_src( $image_src, $image_size );
        $image_srcset = wp_get_attachment_image_srcset( $image_src, $image_size );
        $project_color = get_field('work_color');
      ?>
      <div class="thumbnail thumbnail--project">
        <a href="<?php the_permalink(); ?>" data-bgcolor="<?php echo $project_color ?>" class="thumbnail--project__target">
          <div class="thumbnail--project__content">
            <span class="dash"></span>
            <h3 class="title bold"><?php the_title(); ?></h3>
            <p class="meta"><?php the_field('work_client') ?> / <?php the_field('work_year') ?></p>
          </div>
          <div style="background-color: <?php echo $project_color ?>" class="overlay"></div>
          <div class="thumbnail--project__media">
            <?php echo wp_get_attachment_image( $image_src, $image_size ); ?>
            <!-- Need to compile vanilla-lazyload into the js build in order for srcset lazyload to work -->
            <!-- <img data-srcset="<?php echo esc_attr( $image_srcset ); ?>" data-src="<?php echo $image[0]; ?>" alt="TODO: Replace with alt"> -->
          </div>
        </a>
      </div>
      <?php endwhile; ?>
      <div class="misha_loadmore">More posts</div>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  </div>
</div>
