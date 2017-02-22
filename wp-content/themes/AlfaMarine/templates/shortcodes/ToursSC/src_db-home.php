<article class="tour-list-item item<?=$i?>">
  <div class="item-wrapper">
    <div class="title">
      <h3><a href="<?php echo get_permalink($post->ID()); ?>"><?php echo $post->Title(); ?></a></h3>
      <h4><?php echo $post->CatTree(); ?></h4>
    </div>
    <div class="img">
      <?php
        $img = $post->Image();
        $kiemelt = $post->isHighlighted();
        $exkluziv = $post->isExclusive();
      ?>
      <div class="flags">
        <?php if ($exkluziv): ?>
          <div class="flag flag-exclusive">
            <div class="excstars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
            <?php echo __('exkluzív', TD); ?>
          </div>
        <?php endif; ?>
        <?php if ($kiemelt): ?>
          <div class="flag flag-highlight">
            <i class="fa fa-bullhorn"></i> <?php echo __('kiemelt', TD); ?>
          </div>
        <?php endif; ?>
      </div>
      <a href="<?php echo get_permalink($post->ID()); ?>"><img src="<? echo $img; ?>" alt="<?php echo $post->Title(); ?>"></a>
    </div>
    <?php if ($i == 1): ?>
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
      <?php echo $post->Excerpt(); ?>
      <div class="clearfix"></div>
      <?php if ($i == 1): ?>
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
