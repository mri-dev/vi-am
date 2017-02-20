<?php get_header(); ?>
<?php
  $boat = new Boat(get_the_ID());
?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="boat-page">
    <div class="boat-page-top">
      <div class="images">
        <div class="main">
          <a data-rel="iLightbox[boat<?=$boat->ID()?>]" class="fusion-lightbox"  href="<?=$boat->Image()?>"><img src="<?=$boat->Image()?>" alt="<?php echo $boat->Title(); ?>"></a>
        </div>
      </div>
      <div class="datas">
        <div class="title">
          <h1><?php echo $boat->Title(); ?></h1>
        </div>

        <div class="params">
          <?php foreach ($boat->getParams() as $paramkey => $p): if('--'==$p['value']) continue; ?>
          <div class="param param-<?=$paramkey?>">
            <div class="title">
              <?php echo $p['label']; ?>
            </div>
            <div class="value">
              <?php echo $p['value']; ?>
            </div>
            <div class="clearfix"></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php if ( ($desc = $boat->Description()) ): ?>
    <div class="boat-description">
        <?php echo $desc; ?>
    </div>
    <?php endif; ?>
    <?php if ( ($gallery = $boat->Gallery()) ): ?>
      <a name="gallery"></a>
      <div class="related-list gallery">
        <a name="gallery"></a>
        <h2><?php echo do_shortcode($gallery); ?></h2>
        ...
      </div>
    <?php endif; ?>
    <a name="tours"></a>
    <div class="related-list">
      <h2><?php echo __('Túrák a hajóval', TD); ?></h2>
        <?php echo do_shortcode('[tours view="byboat" control="0" limit="4" orderby="rand" boatid="'.$boat->ID().'"]'); ?>
    </div>
    <div class="related-list">
      <h2><?php echo __('További hajóink', TD); ?></h2>
      <?php echo do_shortcode('[vehicles view="standard" control="0" orderby="rand" excid="'.$boat->ID().'"]'); ?>
    </div>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
