<?php if (have_posts()) : while (have_posts()) : the_post();
$post_date = get_the_date('Y-m-d');
$today     = date('Y-m-d');
$post_month = get_the_date('Y-m');
$this_month = date('Y-m'); ?>

<div class="event <?php echo (is_archive() && $post_date >= $today && $wp_query->current_post == 0 ? "sub-next" : ""); ?>">
  <?php if($post_date >= $today && $wp_query->current_post == 0 ) : ?>

    <div class="event-ribbon">
      <div class="ribbon">
        <div class="ribbon-text"><?php echo ($post_month == $this_month ? 'This Month' : 'Up next'); ?></div>
      </div>
    </div>

  <?php endif; ?>

  <div class="event-content">
  <?php if($post_date <= $today || $wp_query->current_post == 0 ) : ?>
    <div class="event-content-photo">
      <div style="background-image: url('<?php echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ); ?>')" class="photo sub-circle">
        <?php the_post_thumbnail(); ?>
      </div>
    </div>
  <?php endif;?>
    <div class="event-content-info">
      <h3 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <p class="event-date">
        <strong><?php the_date('l, F j, Y'); ?></strong><br>
        <?php if(get_field(location_name)) : ?>
          <a href="http://maps.apple.com/?q=<?php the_field('location_url', $term); ?>">
            <?php the_field('location_name', $term); ?>
          </a>
        <?php endif; ?>
      </p>
      <?php ( is_archive() ? the_excerpt() : the_content() ); ?>
      <?php if(get_field("registration_link")) : ?>
        <p>
          <a href="<?php the_field('registration_link', $term); ?>" class="button">Register</a>
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endwhile; endif; ?>