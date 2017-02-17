<?php
  class Tour
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
