<?php
  class Boat extends AppFactory
  {
    private $id = false;
    private $data = array();

    public function __construct( $id = false )
    {
      parent::__construct();
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

    public function Description()
    {
      $content = apply_filters('the_content', $this->data->post_content);

      if(empty($content)) return false;

      return $content;
    }

    public function Gallery()
    {
      $content = get_post_meta($this->ID(), parent::APP_PREFIX.'galeria_code', true);

      if(empty($content)) return false;

      return $content;
    }

    public function getParams()
    {
      $params = array();

      if($this->boats_metakeys)
      foreach ($this->boats_metakeys as $key => $value) {
        if( !$value['param'] ) continue;
        $params[$key] = array(
          'label' => $value['label'],
          'value' => $this->getMeta($key, '--'),
          'in_list' => (boolean)$value['in_list'],
          'list_label' => $value['list_label'],
        );
      }

      return $params;
    }

    public function MaxFo()
    {
      return (int)8;
    }

    public function ID()
    {
      return (int)$this->data->ID;
    }

    public function Excerpt()
    {
      return get_the_excerpt($this->ID());
    }

    private function load()
    {
      $this->data = get_post($this->id);
    }

    public function getMeta($key, $nometavalue = false)
    {
      $meta = get_post_meta($this->ID(), $key, true);

      if ( !$meta && $nometavalue ) {
        return $nometavalue;
      } else if( !$meta ) {
        return false;
      }

      $meta_info = $this->boats_metakeys[$key];

      if ($meta_info['value_before']) {
       $meta = $meta_info['value_before'].' '.$meta;
      }

      if ($meta_info['value_after']) {
       $meta = $meta.' '.$meta_info['value_after'];
      }

      return $meta;
    }
  } 
?>
