<article class="tour-list-item item<?=$i?>">
  <div class="item-wrapper">
    <div class="title">
      <h3><a href="<?php echo get_permalink($post->ID()); ?>"><?php echo $post->Title(); ?></a></h3>
      <h4><?php echo $post->CatTree(); ?></h4>
    </div>
    <div class="img">
      <?php
        $img = $post->Image();
      ?>
      <a href="<?php echo get_permalink($post->ID()); ?>"><img src="<? echo $img; ?>" alt="<?php echo $post->Title(); ?>"></a>
    </div>
    <?php if (true): ?>
      <div class="after-image-info">
        <div class="rundate" title='<?php echo __('Szezon ideje', TD); ?>'>
          <i class="fa fa-calendar"></i> <strong><?php echo $post->SeasonDate(); ?></strong>
        </div>
        <?php $price = $post->Price(); if($price): ?>
        <div class="price">
          <?php echo $price; ?>
        </div>
        <?php endif; ?>
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
          <div><i class="fa fa-user-circle-o"></i> <?php echo sprintf(__('Maximum <strong>%d</strong> fő', TD), $post->MaxFo()); ?></div>

        </div>
      <?php endif; ?>
      <a class="post-read" href="<?php echo get_permalink($post->ID()); ?>"><?php echo __( 'Túra részletei' ,TD) ?></a>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</article>
