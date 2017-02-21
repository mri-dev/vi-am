<?php

  // Settings
  define( 'PROTOCOL', 'http' );
  define( 'APPPREFIX', 'alfamarine' );
  define( 'TD', 'am' );
  define( 'DEVMODE', true);
  define( 'DOMAIN', $_SERVER['HTTP_HOST'] );
  define( 'FB_APP_ID', '167138103787862' );
  define( 'GOOGLE_API_KEY', '');

  // Routes
  define( 'ROOT', str_replace(get_option('siteurl'), '//'.DOMAIN, get_stylesheet_directory_uri()) );
  define( 'IMG', ROOT.'/images');

  // BACKEND, CONTROLLERS, CLASSES
  require_once "includes/include.php";

  /**
  * Szükséges alap scriptek és stíluslapok
  **/
  function theme_enqueue_styles()
  {
      wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css?t=' . ( (DEVMODE === true) ? time() : '' )  );
      wp_enqueue_style( 'avada-child-stylesheet', ROOT . '/style.css?' . ( (DEVMODE === true) ? time() : '' ) );
  }
  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

  /**
  * Konfig beállítások
  *
  **/
  $app = null;
  function app_init_settings()
  {
    global $app;
    add_post_type_support( 'post', 'excerpt' );
    create_custom_posttypes();

    $app = new AppFactory();
  }
  add_action( 'init', 'app_init_settings' );

  function create_custom_posttypes()
  {
    // Hajók
    $boats = new PostTypeFactory( 'boats' );
  	$boats->set_textdomain( TD );
  	$boats->set_icon('tag');
  	$boats->set_name( 'Hajó', 'Hajók' );
  	$boats->set_labels( array(
  		'add_new' => 'Új %s',
  		'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
  		'not_found' => 'Nincsenek %s a listában.',
  		'add_new_item' => 'Új %s létrehozása',
  	) );

  	$boats->add_taxonomy( 'positions', array(
  		'rewrite' => 'positions',
  		'name' => array('Bevetési hely', 'Bevetési helyek'),
  		'labels' => array(
  			'menu_name' => 'Bevetési helyek',
  			'add_new_item' => 'Új %s',
  			'search_items' => '%s keresése',
  			'all_items' => '%s',
  		)
  	) );
    $boats->add_taxonomy( 'boat_category', array(
      'rewrite' => 'boat_category',
      'name' => array('Kategória', 'Kategóriák'),
      'labels' => array(
        'menu_name' => '%s',
        'add_new_item' => 'Új %s',
        'search_items' => '%s keresése',
        'all_items' => '%s',
      )
    ) );

    $boats_metabox = new CustomMetabox(
      'boats',
      __('Hajó beállítások', TD),
      new BoatsMetaboxSave(),
      'boats'
    );

  	$boats->create();
    add_post_type_support( 'boats', 'excerpt' );

    // Hajótúrák
    $tours = new PostTypeFactory( 'tours' );
    $tours->set_textdomain( TD );
    $tours->set_icon('pressthis');
    $tours->set_name( 'Túra', 'Túrák' );
    $tours->set_labels( array(
      'add_new' => 'Új %s',
      'not_found_in_trash' => 'Nincsenek %s a lomtárban.',
      'not_found' => 'Nincsenek %s a listában.',
      'add_new_item' => 'Új %s létrehozása',
    ) );

    $tours->add_taxonomy( 'tour_category', array(
      'rewrite' => 'tours-c',
      'name' => array('Kategória', 'Kategóriák'),
      'labels' => array(
        'menu_name' => '%s',
        'add_new_item' => 'Új %s',
        'search_items' => '%s keresése',
        'all_items' => '%s',
      )
    ) );

    $tours->add_taxonomy( 'tour_groups', array(
  		'rewrite' => 'tour_groups',
  		'name' => array('Csoport', 'Csoportok'),
  		'labels' => array(
  			'menu_name' => 'Csoportok',
  			'add_new_item' => 'Új %s',
  			'search_items' => '%s keresése',
  			'all_items' => '%s',
  		)
  	) );

    $tours_metabox = new CustomMetabox(
      'tours',
      __('Túra beállítások', TD),
      new ToursMetaboxSave(),
      'tours'
    );

    $tours->create();
    add_post_type_support( 'tours', 'excerpt' );
  }

  /**
  * Egyedi, további stíluslapok
  **/
  function app_theme_enqueue_styles()
  {
    wp_enqueue_style( APPPREFIX, ROOT . '/assets/css/'.APPPREFIX.'.css?t=' . ( (DEVMODE === true) ? time() : '' ) );
  }
  add_action( 'wp_enqueue_scripts', 'app_theme_enqueue_styles', 100 );

  /**
  * OpenGraph támogatás
  **/
  function add_opengraph_doctype( $output )
  {
  	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
  }
  add_filter('language_attributes', 'add_opengraph_doctype');

  /**
  * Logó szlogen
  **/
  function after_logo_content()
  {
    echo '<div class="logo-slogan">'.__('Balatoni és Külföldi hajótúrák', TD).'</div>';
  }
  add_filter('avada_logo_append', 'after_logo_content');

?>
