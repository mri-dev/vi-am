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
              'limit' => 6
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
          $output .= '<div class="pagination">'.$this->pagionation.'</div>';

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
      $list = array();
      $t = new ShortcodeTemplates(__CLASS__.'/'.$this->template);


      //print_r($arg);


      if ( count($list) != 0 ) {
        $o .= '<div class="vehicle-wrapper">';
        foreach ( $list as $e )
        {
          $o .= $t->load_template( array( 'item' => $e ) );
        }
        $o .= '</div>';
      } else {
        ob_start();
        include(locate_template('templates/parts/vehicle-nodata-db.php'));
        $o .= ob_get_contents();
        ob_end_clean();
      }
      return $o;
    }

    private function no_src()
    {
      return sprintf(__('(!) Nincs ilyen source: %s', 'gh'), $this->type);
    }
}

new VehiclesSC();

?>
