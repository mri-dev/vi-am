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
    <?php if (true): ?>
      <div class="after-image-info">
        <div class="rundate">
          <i class="fa fa-calendar"></i> <?php echo __('Jelentkezési határidő', TD); ?>:<br> <strong><?php echo $post->DeadlineDate(); ?></strong>
        </div>
        <div class="price">
          <?php echo $post->Price(); ?>
        </div>
        <div class="clearfix"></div>
      </div>
    <?php endif; ?>
    <div class="desc">
      <div class="desc-wrapper">
        <?php echo $post->Excerpt(); ?>
      </div>
      <div class="clearfix"></div>
      <?php if (true): ?>
        <div class="more-info">
          <div title="<?php echo __('Maximális utasok száma', TD); ?>"><i class="fa fa-user-circle-o"></i> <?php echo sprintf(__('<strong>%d</strong> fő', TD), $post->MaxFo()); ?></div>
          <div title="<?php echo __('Túra ideje', TD); ?>"><i class="fa fa-calendar"></i> <strong><?php echo $post->RunDate(); ?></strong></div>
          <div class="clearfix"></div>
        </div>
      <?php endif; ?>
      <div class="clearfix"></div>
      <a class="post-read" href="<?php echo get_permalink($post->ID()); ?>"><?php echo __( 'Túra részletei' ,TD) ?></a>

    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</article>
