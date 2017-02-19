<?php get_header(); ?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>

	<?php echo do_shortcode('[vehicles view="standard" control="1" limit="16"]'); ?>

</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();
// Omit closing PHP tag to avoid "Headers already sent" issues.
