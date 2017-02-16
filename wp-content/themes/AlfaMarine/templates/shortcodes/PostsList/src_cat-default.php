<article class="post-list-item">
  <div class="item-wrapper">
    <div class="title">
      <h3><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h3>
    </div>
    <div class="img">
      <a href="<?php echo get_permalink($post->ID); ?>"><img src="<? echo get_the_post_thumbnail_url($post->ID); ?>" alt="<?php echo $post->post_title; ?>"></a>
    </div>
    <div class="desc">
      <?php echo get_the_excerpt($post->ID); ?>
    </div>
    <div class="date">
      <?php echo get_the_date(get_option('date_format',''), $post->ID); ?>
    </div>
    <a class="post-read" href="<?php echo get_permalink($post->ID); ?>"><?php echo __( 'Részletek' ,TD) ?></a>
  </div>
</article>
