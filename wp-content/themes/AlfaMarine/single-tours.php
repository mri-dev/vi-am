<?php get_header(); ?>
<?php
  $tour = new Tour(get_the_ID());
?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="tour-page">
    <div class="header">
      <h1><?php echo $tour->Title(); ?></h1>
      <div class="cat-links">
        <?php foreach( $tour->CatTree( true ) as $tc ): ?>
          <a href="<?php echo get_term_link($tc->term_id); ?>"><?php echo $tc->name; ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="in-content">
      <?php echo $tour->Content(); ?>
    </div>
    <div class="info-line">
      <div class="page-wrapper">
        <div class="icon">
          <i class="fa fa-ship"></i>
        </div>
        <div class="con">
          <div class="price">
            <?php echo __('A feltüntetett árak tájékoztató jellegűek. A jelölt árak a túra alapára, mely tartalmazza az ÁFA-t. A végső ár függ az extra szolgáltatásoktól, illetve attól, hogy milyen speciális igényeket kérnek.', TD); ?>
            <br><br>
            <?php echo __('Az alapár <strong>NEM</strong> tartalmazza a transzfer költségeket, repülőjegyet és a kikötőig való eljutást. Tengeri túra esetén ez <strong>személyenként kb. + €300 / fő</strong> költséget jelent.', TD); ?>
          </div>
          <div class="extras">
            <h3><?php echo __('Extrák', TD); ?>:</h3>
            <div class="">
              <ul>
                <li><?php echo __('egyedi igények alapján a túra személyre szabható', TD); ?>,</li>
                <li><?php echo __('transzfer és külön repülőjárat igény esetén', TD); ?>,</li>
                <li><?php echo __('extra személyzet és legénység', TD); ?>,</li>
                <li><?php echo __('különleges ellátás és szállás', TD); ?>.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="contact">
      <div class="page-wrapper">
        <?php echo do_shortcode('[contact]'); ?>
      </div>
    </div>
    <div class="more-tours">
      <div class="page-wrapper">
        <h3 class="title"><?php echo __('További túráink', TD); ?></h3>
        <?php echo do_shortcode('[tours control="0" view="byboat" exc_id="'.$tour->ID().'"]'); ?>
      </div>
    </div>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
