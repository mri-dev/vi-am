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
  function app_init_settings()
  {
    add_post_type_support( 'post', 'excerpt' );
  }
  add_action( 'init', 'app_init_settings' );


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
