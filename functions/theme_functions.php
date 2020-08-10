<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
   * Print result with pre tag
   *
   * @param $lang string
   * 
   * @author Wedesin
   * @return echo string
   */ 

if ( !function_exists('preprint') ) {

  function preprint( $print ) {

    echo '<pre>';

    echo print_r( $print );

    echo '</pre>';

  }
  
}
  
/**
 * Removes [...] from the excerpt and allows you to set the number of words in there
 *
 * @param text
 * 
 * @author Wedesin
 * @return true/false
 */ 
if ( !function_exists('filter_excerpt_wedesin') ) { 

    function filter_excerpt_wedesin($text) {
      if ($text == '')
      {
        $text = get_the_content('');
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text);
        $text = nl2br($text);
        $excerpt_length = apply_filters('excerpt_length', 20);
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
          array_pop($words);
          array_push($words, '...');
          $text = implode(' ', $words);
        }
      }
      return $text;
    }
    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter('get_the_excerpt', 'filter_excerpt_wedesin');
  
}
  
/**
 * Fix google map api
 *
 * @param none
 * 
 * @author Wedesin
 * @return true/false
 */ 
if ( !function_exists('acf_google_map_api_wedesin') ) { 

    function acf_google_map_api_wedesin( $api ){
      
      $api['key'] = 'XXX';
      
      return $api;
      
    }
  
    add_filter('acf/fields/google_map/api', 'acf_google_map_api_wedesin');
  
}

/**
 * returns check if current language is as desired
 *
 * @param $lang string
 * 
 * @author Wedesin
 * @return true/false
 */ 

if ( !function_exists('is_lang') ) {

    function is_lang( $lang ){
  
      $compare = "";
      if ( $lang == "en" ) {
        $compare ="en-GB";
      } else if ( $lang == "cz"  ) {
        $compare="cs-CZ";
      }
  
      $currentlang = get_bloginfo('language');
  
      if ( $currentlang == $compare) {
        return true;
      } else {
        return false;
      }
  
    }
  
}
  
  
/**
   * returns defined string for each language, first is czech, english second 
   *
   * @param $lang string
   * 
   * @author Wedesin
   * @return echo string
   */ 
if ( !function_exists('add_new_mime_types_end') ) {
  
    function add_new_mime_types_end($mime_types){
        $mime_types['ogv'] = 'application/ogg'; //Adding svg extension
        return $mime_types;
    }
    add_filter('upload_mimes', 'add_new_mime_types_end', 1, 1);
  
}

/**
 * Add svg icon
 *
 * @param none
 * 
 * @author Wedesin
 * @return echo/false
 */ 
if ( !function_exists('the_icon') ) {
 
  function the_icon( $value, $class="" ) {

    if ( file_exists( get_stylesheet_directory() . '/assets/svg/' . $value . ".svg" ) )

      echo '<span class="svg-icon ' . $class. '">' . file_get_contents( get_theme_file_uri( '/assets/svg/' . $value . '.svg' ) ) . '</span>';

    else 

      return false;
  
  }
 
}

/**
   * return icon url
   *
   * @param $lang string
   * 
   * @author Wedesin
   * @return echo string
   */ 

if ( !function_exists('get_svg_url') ) {

    function get_svg_url( $value ) {
  
      return get_stylesheet_directory_uri() . '/assets/svg/' . $value . ".svg";
  
    }
  
  }
  
/**
   * Rename options menu
   *
   * @param $lang string
   * 
   * @author Wedesin
   * @return echo string
   */ 
if (function_exists('acf_set_options_page_menu')){
  acf_set_options_page_menu('Nastavení webu');
}


/**
 * // změna canonical adres v yoastu na první stránku pří stránkování
 *
 * @param none
 * 
 * @author Wedesin
 * @return true/false
 */ 
/*
function yoast_seo_canonical_change_woocom_shop( $canonical ) {
	if ( function_exists('is_product_category') && is_product_category() ) {
    global $wp_query;
    $catID = $wp_query->get_queried_object()->term_taxonomy_id;
    return  get_term_link( $catID, 'product_cat' ); 
  
  } else if (is_home()) {
    return get_permalink( get_option( 'page_for_posts' ) );
  
  } else if ( function_exists('is_shop') && is_shop()){
    return get_permalink( wc_get_page_id( 'shop' ) );
  
  } else if (is_post_type_archive()){

    global $wp_query;
    return get_post_type_archive_link($wp_query->query['post_type']);
    
  } else if( is_search() ) {
      return home_url();
  }else {
    return $canonical;
  }
}
add_filter( 'wpseo_canonical', 'yoast_seo_canonical_change_woocom_shop', 10, 1 );*/

/**
 * User redirect to refferer
 *
 * @param none
 * 
 * @author Wedesin
 * @return true/false
 */ 
if ( !function_exists( 'redirect_back' ) ) {
  function redirect_back(){
    $location = $_SERVER['HTTP_REFERER'];
    wp_safe_redirect($location);
    exit();
  }
}
