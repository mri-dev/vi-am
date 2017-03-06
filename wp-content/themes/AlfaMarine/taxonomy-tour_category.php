<?php get_header(); ?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php echo do_shortcode('[tours view="standard" control="1" limit="30" autocat="1"]'); ?>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();
// Omit closing PHP tag to avoid "Headers already sent" issues.
