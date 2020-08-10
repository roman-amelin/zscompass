<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * clean up wordpress setting and remove emojis
 *
 * @param none
 * 
 * @author Wedesin
 * @return void
 */ 

remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

//disable emojis
if ( !function_exists('disable_wp_emojicons_CWT') ) { 

  function disable_wp_emojicons_CWT() {
    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce_CWT' );
  }
  add_action( 'init', 'disable_wp_emojicons_CWT' );

}

if ( !function_exists('disable_emojicons_tinymce_CWT') ) { 

  function disable_emojicons_tinymce_CWT( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }

}


/**
 * Removed admin links in menu
 *
 * @param none
 * 
 * @author Wedesin
 * @return void
 */ 
if ( !function_exists('remove_menu_pages_wedesin') ) {
  
    function remove_menu_pages_wedesin() {
        
        remove_menu_page('link-manager.php');
        remove_menu_page('edit-comments.php');
    }

    add_action( 'admin_menu', 'remove_menu_pages_wedesin' );
  
}

/**
 * Theme setup
 *
 * @param none
 * 
 * @author Wedesin
 * @return void
 */ 
if ( !function_exists('site_setup_wedesin') ) { 

    function site_setup_wedesin() {
  
      //load theme text domain
      load_theme_textdomain( TM, get_template_directory() . '/languages' );
  
      // Enable support 
      add_theme_support('post-thumbnails');  
      add_theme_support('menus');
      add_theme_support( "title-tag" );
      add_filter('widget_text', 'do_shortcode');
  
          //ACF sections
      if ( function_exists('acf_add_options_sub_page') ) { 
        acf_add_options_sub_page( 'Obecné nastavení' );
        acf_add_options_sub_page( 'Záhlaví' );
        acf_add_options_sub_page( 'Zápatí' );
      }
  
      /*add_image_size('page-banner', 1900, 500, true);
      add_image_size('vertical', 1000, 2000, true);
      add_image_size('room-thumb', 600, 500, true);
      add_image_size('gallery-thumb', 440, 330, true);
      add_image_size('gallery-tiny', 220, 150, true);*/
  
      // Register menus
      register_nav_menus(
        array(
          'primary' => __( 'Primární menu', TM ),   // Main nav in header
          'footer' => __( 'Menu zápatí', TM ) // Secondary nav in footer
        )
      );
  
      // Adding post format support
        add_theme_support( 'post-formats',
            array(
                'aside',             // title less blurb
                'gallery',           // gallery of images
                'link',              // quick link to other site
                'image',             // an image
                'quote',             // a quick quote
                'status',            // a Facebook like status update
                'video',             // video
                'audio',             // audio
                'chat'               // chat transcript
            )
        ); 
  
        // Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
        $GLOBALS['content_width'] = 1200;	
  
      //declare woocommerce support
      //add_theme_support( 'woocommerce' );
  
    }
    add_action('after_setup_theme', 'site_setup_wedesin');
  
  }