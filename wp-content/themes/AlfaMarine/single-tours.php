<?php get_header(); ?>
<?php
  $tour = new Tour(get_the_ID());
?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="tour-page">
    <div class="header">
      <h1><?php echo $tour->Title(); ?></h1>
    </div>
    <div class="in-content">
      <?php echo $tour->Content(); ?>
    </div>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
