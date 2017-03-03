<?php
class ToursSC
{
    const SCTAG = 'tours';
    private $template = 'default';
    private $attr = array();
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
        $output = '';

    	  /* Set up the default arguments. */
        $defaults = apply_filters(
            self::SCTAG.'_defaults',
            array(
              'view'  => 'default',
              'limit' => 30,
              'src'   => 'db',
              'orderby' => 'date',
              'order' => 'DESC',
              'control' => 1,
              'autocat' => 0,
              'exc_id' => ''
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

        if ($this->attr['control'] == 1) {
            $output .= '<div class="pagination">'.$this->pagionation.'</div>';
        }

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }

    private function src_db()
    {
      $o = '<div class="post-content sc-'.strtolower(__CLASS__).'-'.strtolower(__FUNCTION__).'-holder style-'.$this->template.'">';

      $data = array();
      $parent = false;
      $exc_ids = array();

      $excid = (empty($this->attr['exc_id'])) ? array() : explode(",", $this->attr['exc_id']);

      $paged = (get_query_var('page')) ? get_query_var('page') : 0;
      $qryparam = array(
        'post_type' => 'tours',
        'orderby' => $this->attr['orderby'],
        'order' => $this->attr['order'],
        'posts_per_page' => $this->attr['limit'],
        'paged' => $paged,
        'post__not_in' => $excid
      );

      // Tax query
      if($this->attr['autocat'] == 1) {
        $termobj = get_queried_object();
        if($termobj) {
          $qryparam['tax_query'][] = array(
            array(
              'taxonomy' => 'tour_category',
              'field' => 'ID',
              'terms' => $termobj->term_id
            )
          );
        }
        $price_by = ( $termobj->slug == 'tengeri-turak') ? 'kulfold' : 'belfold';
      }

      if(isset($_GET['c']) && !empty($_GET['c']))
      {
        $cat = $_GET['c'];

        $qryparam['tax_query'][] = array(
          array(
            'taxonomy' => 'tour_category',
            'field' => 'slug',
            'terms' => $cat
          )
        );
      }

      if(isset($cat)) {
        $price_by = ( $cat == 'tengeri-turak') ? 'kulfold' : 'belfold';
      }

      if ($this->attr['control'] == 1)
      {
          $srcname = '';

          if(isset($cat)) {
            $srcname .= ( $cat == 'tengeri-turak') ? ' Tengeri ' : 'Balatoni ';
          }

          $srcname .= $termobj->name;
          $o .= '<div class="sc-header">';
          $o .= '<h1 class="heading">'.sprintf(__('Válasszon <strong>%s</strong> közül', TD), $srcname).'</h1>';
          $o .= '</div>';
      }

      // View
      $t = new ShortcodeTemplates(__CLASS__.'/'.__FUNCTION__.( ($this->template ) ? '-'.$this->template:'' ));


      $pages = new WP_Query($qryparam);

      if ($pages->have_posts())
      {
        $o .= '<div class="list-wrapper">';
        $this->max_num_pages = ceil( $pages->found_posts / $this->attr['limit']);

        while ( $pages->have_posts() )
        {
          $tour_arg = array(
            'price_by' => $price_by
          );

          $pages->the_post();
          $i++;
          $tour = new Tour(get_the_ID(), $tour_arg);
          $data['i'] = $i;
          $data['post'] = $tour;

          $o .= $t->load_template($data);
        }

        $this->pagionation = paginate_links( array(
          'base' => $_SERVER['REQUEST_URI'].'%_%',
          'format' => '?page=%#%',
          'current' => max( 1, get_query_var('page') ),
          'total' => $this->max_num_pages
        ) );
        wp_reset_postdata();
        $o .= '</div>';
      } else {
        ob_start();
        include(locate_template('templates/parts/tours-nodata-'.$this->template.'.php'));
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

}
new ToursSC();

?>
