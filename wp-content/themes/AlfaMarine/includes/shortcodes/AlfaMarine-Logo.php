<?php
class AlfaMarineLogo
{
    const SCTAG = 'alfamarine-logo';

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
              'color' => 'default',
              'size' => 250
            )
        );

        /* Parse the arguments. */
        $attr  = shortcode_atts( $defaults, $attr );

        switch ($attr['color']) {
          case 'white':
            $img_mode = '_white';
          break;

          default: case 'default':
            $img_mode = '';
          break;
        }

        $output .= '<div class="custom-footer-logo"><a title="'.get_option('blogname', '').'" href="'.get_option('siteurl', '').'"><img src="'.IMG.'/alfamarine_logo'.$img_mode.'.svg" style="max-width: '.$attr['size'].'px;" alt="'.get_option('blogname', '').'"/></a></div>';



        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}

new AlfaMarineLogo();

?>
