<?php
class TourParameterSC
{
    const SCTAG = 'tour-parameter';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
      global $post, $app;

        $data = array();
        $tour_params = array();

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'view' => 'v1',
              'what' => false
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        foreach ($app->get_tours_metakeys() as $key => $value)
        {
          if(strpos($key, $attr['what']) === false && $value['global'] !== true ) continue;
          $tour_params[] = array(
            'name' => $value['list_label'],
            'value' => $value['value_before'].get_post_meta($post->ID, $key, true).$value['value_after']
          );
        }


        $output = '<div class="sc-'.self::SCTAG.'-holder view-'.$attr['view'].'">';

        $data['params'] = $attr;
        $data['tour_params'] = $tour_params;

        $t = new ShortcodeTemplates(__CLASS__.'/'.$attr['view']);

        $output .= $t->load_template( $data );
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}
new TourParameterSC();

?>
