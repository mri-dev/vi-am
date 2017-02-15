<?php
class TaglineSharesSC
{
    const SCTAG = 'tagline-shares';

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
            )
        );

        /* Parse the arguments. */
        $attr  = shortcode_atts( $defaults, $attr );

        // Social icons
        $social = new Avada_Social_Icons();
        $icons_html = $social->render_social_icons(array('position' => 'header'));
        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );
        $output .= $icons_html;
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}

new TaglineSharesSC();

?>
