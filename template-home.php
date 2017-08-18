<?php
/**
 * Template Name: Home
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
          $repeater = get_field( 'home_video' );
          $rand = rand(0, (count($repeater) - 1));
          echo "<video autoplay loop muted poster='' id='heroVideo'><source src= '".$repeater[$rand]['home_video_file']."' type='video/mp4'></video>"
        ?>
      </div>
      <div class="small-12 medium-6 column align-self-bottom">
        <div class="hero__content">
          <h1 class="statement"><?php the_field('home_introduction')?></h1>
        </div>
      </div>
      <div class="hero__hint">
        <p class="hero__hint__text"><?php the_field('home_hint')?></p>
        <div class="hero__hint__icon icon">
          <svg>
            <use xlink:href="images/svg-sprite.svg#icon__scroll"></use>
          </svg>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$posts = get_posts(array(
  'numberposts'	=> 4,
  'post_type'   => array( 'work' ),
  'meta_query'  => array(
    array(
      'key' => 'work_frontpage',
      'compare' => '==',
      'value' => '1'
    )
  )
));

if( $posts ): ?>

<div class="container">
  <div class="collection collection--projects collection--projects-frontpage">
    <div class="projects">
      <?php foreach( $posts as $post ): setup_postdata( $post );
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
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php wp_reset_postdata(); ?>
<?php endif; ?>
