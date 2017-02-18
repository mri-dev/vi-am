<article class="tour-list-item item<?=$i?>">
  <div class="item-wrapper">
    <div class="title">
      <h3><a href="<?php echo get_permalink($post->ID()); ?>"><?php echo $post->Title(); ?></a></h3>
      <h4>A túra alcíme</h4>
    </div>
    <div class="img">
      <?php
        $img = $post->Image();
      ?>
      <a href="<?php echo get_permalink($post->ID()); ?>"><img src="<? echo $img; ?>" alt="<?php echo $post->Title(); ?>"></a>
    </div>
    <?php if ($i == 1): ?>
      <div class="after-image-info">
        <div class="rundate">
          <i class="fa fa-calendar"></i> <?php echo __('Jelentkezési határidő', TD); ?>: <strong><?php echo $post->DeadlineDate(); ?></strong>
        </div>
        <div class="price">
          <?php echo $post->Price(); ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="desc">
      <?php echo $post->Excerpt(); ?>
      <div class="clearfix"></div>
      <?php if ($i == 1): ?>
        <div class="more-info">
          <span><i class="fa fa-user-circle-o"></i> <?php echo sprintf(__('Maximum <strong>%d</strong> fő', TD), $post->MaxFo()); ?></span>
          <span><i class="fa fa-calendar"></i> <?php echo __('Túra ideje', TD).': '.$post->RunDate(); ?></span>
        </div>
      <?php endif; ?>
      <a class="post-read" href="<?php echo get_permalink($post->ID()); ?>"><?php echo __( 'Túra részletei' ,TD) ?></a>
      <div class="clearfix"></div>
    </div>
  </div>
</article>
