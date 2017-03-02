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
        <div class="rundate" >
          <em><?php echo __('Minimális túra ideje', TD); ?>:</em><br>
          <?php echo $post->DateInfos(); ?>
        </div>
        <div class="price" title='<?php echo __('Balatoni túra esetén értendő alapár', TD); ?>'>
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
        <div class="more-info" title="<?php echo __('Résztvevők száma (min-max)', TD); ?>">
          <div><i class="fa fa-user-circle-o"></i> <?php echo $post->MaxFo(); ?></div>
        </div>
        <a class="post-read" href="<?php echo get_permalink($post->ID()); ?>"><?php echo __( 'Túra részletei' ,TD) ?></a>
      <?php endif; ?>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
</article>
