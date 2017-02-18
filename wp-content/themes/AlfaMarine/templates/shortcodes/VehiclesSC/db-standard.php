<article class="vehicle-list-item item<?=$i?>">
  <div class="item-wrapper">
      <div class="title">
        <h3><a href="<?php echo get_permalink($post->ID()); ?>"><?php echo $post->Title(); ?></a></h3>
      </div>
      <div class="img">
        <a href="<?php echo get_permalink($post->ID()); ?>"><img src="<?php echo $post->Image(); ?>" alt="<?php echo $post->Title(); ?>"></a>
      </div>
    <div class="params">
      <?php foreach($post->getParams() as $paramkey => $param): ?>
        <div class="param param-<?php echo $paramkey; ?>">
          <span class="text">
            <?php echo $param['label']; ?>
          </span>
          <span class="value">
            <?php echo $param['value']; ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="button">
    <a href="<?php echo get_permalink($post->ID()); ?>"><?php echo __('Hajó adatlap', TD); ?> <i class="fa fa-arrow-circle-right"></i></a>
  </div>
  <div class="clearfix"></div>
</article>
