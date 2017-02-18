<?php
class VehiclesSC
{
    const SCTAG = 'vehicles';

    // Elérhető set-ek
    public $params = array();
    public $template = 'standard';
    public $type;
    public $pagionation = null;

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
      $o = '<div class="sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'">';

      $pages = get_posts(array(
        'post_type' => 'boats',
        'orderby' => $this->params['orderby'],
        'order' => $this->params['order'],
        'post_per_page' => $this->params['limit']
      ));

      if ( count($pages) != 0 ) {
        $o .= '<div class="vehicle-list-wrapper">';
        foreach ( $pages as $e )
        {
          $i++;
          $boat = new Boat($e->ID);
          $data['i'] = $i;
          $data['post'] = $boat;

          $o .= $t->load_template( $data );
        }
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

    private function no_src()
    {
      return sprintf(__('(!) Nincs ilyen source: %s', 'gh'), $this->type);
    }
}

new VehiclesSC();

?>
