<?php
class AlfaMarine
{
    const SCTAG = 'alfamarine';

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
        $output = '';

        /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'data' => false,
              'for' => false
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        switch( $attr['data'] ){
          case 'contact':
            $output .= $this->data_contact();
          break;
          case 'facebook-box':
            $output .= $this->data_facebookbox();
          break;
          case 'draw.sailboat':
            $output .= $this->draw_sailboat();
          break;
          default:
          break;
        }

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    private function data_contact()
    {
      $o = '';


      // Phone
      $phone = '+36 1 123 456';
      $o .= '<div class="am-contact contact-phone"><i class="fa fa-phone"></i> '.$phone.'</div>';

      // Email
      $mail = 'info@alfamarine.hu';
      $o .= '<div class="am-contact contact-email"><i class="fa fa-envelope"></i> <a href="mailto:'.$mail.'">'.$mail.'</a></div>';

      return $o;
    }

    private function data_facebookbox()
    {
      $o = '<div class="footer-facebook-likebox"><iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffacebook&tabs&width=340&height=214&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=true&appId='.FB_APP_ID.'" width="340" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';

      return $o;
    }

    private function draw_sailboat()
    {
      $o = '';

      $o .= '<div class="draw sailboat-draw"><img src="'.IMG.'/sailboat.svg" alt="Sail Boat"/></div>';
      return $o;
    }
}

new AlfaMarine();

?>
