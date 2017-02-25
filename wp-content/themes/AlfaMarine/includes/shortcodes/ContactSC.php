<?php
class ContactSC
{
    const SCTAG = 'contact';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {

        $data = array();

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'view' => 'v1'
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $output = '<div class="sc-'.self::SCTAG.'-holder view-'.$attr['view'].'">';

        $data['params'] = $attr;

        $t = new ShortcodeTemplates(__CLASS__.'/'.$attr['view']);

        $output .= $t->load_template( $data );
        $output .= '</div>';


        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}
new ContactSC();

?>
