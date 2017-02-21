<?php
  class Tour extends AppFactory
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

    public function MaxFo()
    {
      return (int)8;
    }

    public function Price()
    {
      return get_post_meta($this->ID(), self::APP_PREFIX.'ar', true);
    }
    public function RunDate()
    {
      return date(get_option('date_format', ''));
    }

    public function SeasonDate()
    {
      return date(get_option('date_format', '')) . ' &mdash; '.date(get_option('date_format', ''));
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
  } 
?>
