<?php
  class ToursMetaboxSave extends AppFactory implements MetaboxSaver
  {
    public function __construct() {
      parent::__construct();
    }

    public function saving( $post_id, $post )
    {
      $params = $this->get_tours_metakeys();
      foreach ($params as $k => $v)
      {
        update_post_meta($post_id, $k, $_POST[$k]);
      }
    }
  }
?>
