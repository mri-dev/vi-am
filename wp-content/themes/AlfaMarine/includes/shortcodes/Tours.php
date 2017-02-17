<?php
class ToursSC
{
    const SCTAG = 'tours';
    private $template = 'default';
    private $attr = array();

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        $output = '';

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'view'  => 'default',
              'limit' => 30,
              'src'   => 'db',
              'orderby' => 'date',
              'order' => 'DESC'
            )
        );
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $this->attr = (array)$attr;
        $this->template = $attr['view'];

        switch ($attr['src']) {
          case 'db':
            $output .= $this->src_db();
          break;
          default:
            $output .= 'NODATA';
          break;
        }

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    private function src_db()
    {
      $o = '<div class="sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'"><div class="list-wrapper">';

      $data = array();
      $parent = false;

      // View
      $t = new ShortcodeTemplates(__CLASS__.'/'.__FUNCTION__.( ($this->template ) ? '-'.$this->template:'' ));

      $pages = get_posts(array(
        'post_type' => 'tours',
        'orderby' => $this->attr['orderby'],
        'order' => $this->attr['order'],
        'post_per_page' => $this->attr['limit']
      ));

      if ($pages)
      {
        foreach ($pages as $page) {
          $i++;

          $tour = new Tour($page->ID);
          $data['post'] = $tour;

          $o .= $t->load_template($data);
        }
      } else {

      }

      $o .= '</div></div>';

      return $o;
    }

}
new ToursSC();

?>
