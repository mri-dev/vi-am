<?php
  class Boat
  {
    private $id = false;
    private $data = array();

    public function __construct( $id = false )
    {
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

    public function getParams()
    {
      $params = array();
      for ($i=0; $i < 5 ; $i++) {
        $params['param'.$i] = array(
          'label' => 'param'.$i,
          'value' => 'value'.$i
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
  } 
?>
