<?php
  class Tour extends AppFactory
  {
    const GROUP_KEY_HIGHLIGHTED = 'kiemelt';
    const GROUP_KEY_EXCLUSIVE = 'exkluziv';

    private $id = false;
    private $data = array();
    public $show_price_by = 'belfold';

    public function __construct( $id = false, $arg = array() )
    {
      parent::__construct();

      if(isset($arg['price_by'])) {
        $this->show_price_by = $arg['price_by'];
      }

      $this->id = $id;
      $this->load();
      return $this;
    }

    public function Title()
    {
      return $this->data->post_title;
    }

    public function Image()
    {
      $img = get_the_post_thumbnail_url($this->ID());

      if( !$img ) return 'https://placeholdit.imgix.net/~text?txtsize=33&txt=640x480&w=640&h=480';

      return $img;
    }

    public function CatTree( $raw = false )
    {
      $terms = wp_get_post_terms($this->ID(), 'tour_category');
      $term_exp = '';

      if ($terms) {

        if($raw) return $terms;

        foreach ($terms as $t) {
          $term_exp .= '<a href="'.get_term_link($t->term_id).'">'.$t->name.'</a>, ';
        }

        $term_exp = rtrim($term_exp, ', ');

      } else return false;

      return $term_exp;
    }

    public function Groups()
    {
      $terms = wp_get_post_terms($this->ID(), 'tour_groups');
      $data = array();

      if ($terms) {
        foreach ($terms as $t) {
          $data['list_slug'][] = $t->slug;
          $data['list_id'][] = $t->term_id;
          $data['raw'][$t->term_id] = $t;
        }
      } else return false;

      return $data;
    }

    public function isHighlighted()
    {
      $g = $this->Groups();

      if( in_array(self::GROUP_KEY_HIGHLIGHTED, (array)$g['list_slug']) )
      {
        return true;
      } else {
        return false;
      }
    }

    public function isExclusive()
    {
      $g = $this->Groups();

      if( in_array(self::GROUP_KEY_EXCLUSIVE, (array)$g['list_slug']) )
      {
        return true;
      } else {
        return false;
      }
    }

    public function MaxFo()
    {
      $belfold = get_post_meta($this->ID(), parent::APP_PREFIX.'reszvevok_belfold', true);
      $kulfold = get_post_meta($this->ID(), parent::APP_PREFIX.'reszvevok_kulfold', true);
      return
        '<span class="belfold">'.sprintf(__('Balaton: <strong>%s fő</strong>', TD), $belfold).'</span>'.
        (!empty($kulfold) ? ', <span class="kulfold">'.sprintf(__('Tenger: <strong>%s fő</strong>', TD), $kulfold).'</span>' : '');
    }

    public function Price()
    {
      $pb = $this->show_price_by;
      $price = get_post_meta($this->ID(), parent::APP_PREFIX.'ar_'.$pb, true);

      if(empty($price)) return false;

      return $price;
    }
    public function RunDate()
    {
      return date(get_option('date_format', ''));
    }

    public function SeasonDate()
    {
      return date(get_option('date_format', '')) . ' &mdash; '.date(get_option('date_format', ''));
    }

    public function DateInfos()
    {
      $belfold = get_post_meta($this->ID(), parent::APP_PREFIX.'minido_belfold', true);
      $kulfold = get_post_meta($this->ID(), parent::APP_PREFIX.'minido_kulfold', true);
      return
        '<span class="belfold">'.sprintf(__('Balaton: <strong>%s</strong>', TD), $belfold).'</span>'.
        (!empty($kulfold) ? ', <span class="kulfold">'.sprintf(__('Tenger: <strong>%s</strong>', TD), $kulfold).'</span>' : '');
    }


    public function ID()
    {
      return (int)$this->data->ID;
    }

    public function Excerpt()
    {
      return get_the_excerpt($this->ID());
    }

    public function Content()
    {
      return apply_filters('the_content', $this->data->post_content);
    }

    private function load()
    {
      $this->data = get_post($this->id);
    }
  } 
?>
