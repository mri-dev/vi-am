<?php
class VehiclesSC
{
    const SCTAG = 'vehicles';

    // Elérhető set-ek
    public $params = array();
    public $template = 'standard';
    public $type;
    public $pagionation = null;
    public $max_num_pages = 1;

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
        /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'src' => 'db',
              'view' => 'standard',
              'limit' => 16,
              'orderby' => 'menu_order',
              'order' => 'ASC',
              'control' => 1
            )
        );

        /* Parse the arguments. */
        $attr           = shortcode_atts( $defaults, $attr );
        $this->params   = $attr;
        $this->type     = $attr['src'];
        $this->template = $attr['view'];

        $output = '<div class="'.self::SCTAG.'-holder style-'.$this->template.'">';

        if (!is_null($attr['src']))
        {
          $output .= '<div class="'.self::SCTAG.'-set-'.$this->type.'">';
          switch ( $this->type )
          {
            case 'db':
              $output .= $this->db();
            break;

            default:
              $output .= $this->no_src();
            break;
          }
          $output .= '</div>';

          if ($this->params['control'] == 1) {
              $output .= '<div class="pagination">'.$this->pagionation.'</div>';
          }
        }

        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    /**
    * Minden lekérés
    **/
    private function db( $arg = array() )
    {
      $pages = array();
      $data = array();

      $t = new ShortcodeTemplates(__CLASS__.'/'.__FUNCTION__.( ($this->template ) ? '-'.$this->template:'' ));
      //print_r($arg);
      $o = '<div class="post-content sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'">';

      if ($this->params['control'] == 1) {
          $o .= '<div class="sc-header">';
          $o .= '<h1 class="heading">'.__('Hajóink', TD).'</h1>';
          $o .= '</div>';
      }

      $paged = (get_query_var('page')) ? get_query_var('page') : 0;
      $pages = new WP_Query(array(
        'post_type' => 'boats',
        'orderby' => $this->params['orderby'],
        'order' => $this->params['order'],
        'posts_per_page' => $this->params['limit'],
        'paged' => $paged
      ));
      $this->max_num_pages = ceil( $pages->found_posts / $this->params['limit']);
      if ( $pages->have_posts() ) {
        $o .= '<div class="vehicle-list-wrapper">';
        while ( $pages->have_posts() )
        {
          $pages->the_post();
          $i++;
          $boat = new Boat(get_the_ID());
          $data['i'] = $i;
          $data['post'] = $boat;

          $o .= $t->load_template( $data );
        }

        $this->pagionation = paginate_links( array(
        	'base' => '%_%',
        	'format' => '?page=%#%',
        	'current' => max( 1, get_query_var('page') ),
        	'total' => $this->max_num_pages
        ) );

        wp_reset_postdata();
        $o .= '</div>';
      } else {
        ob_start();
        include(locate_template('templates/parts/vehicle-nodata-db.php'));
        $o .= ob_get_contents();
        ob_end_clean();
      }

      $o .= '</div>';

      return $o;
    }

    public function pagination()
    {
      echo $this->pagination;
    }

    private function no_src()
    {
      return sprintf(__('(!) Nincs ilyen source: %s', 'gh'), $this->type);
    }
}

new VehiclesSC();

?>
