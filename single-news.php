<?php while (have_posts()) : the_post();
  $image_src = get_field('news_thumbnail');
  $image_size = 'img-xxlarge';
  $image = wp_get_attachment_image_src( $image_src, $image_size );
  $image_srcset = wp_get_attachment_image_srcset( $image_src, $image_size );
?>
<div class="container container--fixed container--fullscreen">
  <div class="hero--news">
    <div class="hero--news__media">
      <?php echo wp_get_attachment_image( $image_src, $image_size ); ?>
    </div>
  </div>
</div>
<div class="container container--news__content">
  <div class="news__content">
    <div class="news__content__title-group">
      <h1 class="title"><?php the_title(); ?></h1>
      <p class="meta date"><?php the_time('F n, Y') ?></p>
    </div>
    <div class="news__content__content">
      <?php the_field('news_description'); ?>
    </div>
  </div>
</div>
<?php endwhile; ?>
