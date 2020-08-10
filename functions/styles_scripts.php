<?php 

/**
 * Theme styles and scripts
 *
 * 
 * @author Wedesin
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'registerStylesScripts' ) )
{
	class registerStylesScripts
	{

		public function __construct()
		{
			
			//register scripts
      add_action( 'wp_enqueue_scripts' , [$this, 'register_js_scripts_add_wedesin']);

      //admin scripts
      add_action( 'admin_enqueue_scripts' , [$this,'endorfin_enqueue_admin_scripts'] );

      //move scripts to the footer
      add_action( 'wp_enqueue_scripts' , [$this,'wedesin_remove_head_scripts'] );

      //show registred scripts
      //add_action( 'wp_print_scripts', [$this,'wpa54064_inspect_scripts'] );

      //remove scripts
      add_action( 'wp_enqueue_scripts' , [$this,'wpdocs_dequeue_script'], 100 );

      //defer css and js
      add_action( 'wp_footer', [$this,'defer_css'], PHP_INT_MAX );
      add_filter( 'script_loader_tag', [$this,'defer_parsing_of_js'], 10 );

    }
    
    /**
     * Register
     *
     * @param none
     * 
     * @author Wedesin
     * @return void
     */ 
    function register_js_scripts_add_wedesin() {
  
      global $wp_styles, $wp_scripts;
           
      // Register main stylesheet
      wp_enqueue_style( 'main-css', get_template_directory_uri() . '/assets/styles/style.css', array(), filemtime( get_template_directory() . '/assets/styles/scss'), 'all' );
  
      // Register javacript
      $apptime = filemtime( get_stylesheet_directory() . '/assets/scripts/scripts.js');
      wp_enqueue_script( 'global', get_template_directory_uri() . '/assets/scripts/scripts.js', array( 'jquery' ), $apptime, true );
      
      // Comment reply script for threaded comments
      if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
        wp_enqueue_script( 'comment-reply' );
      }
    
    }

    /**
     * Add admin scripts if required
     *
     * @param none
     * 
     * @author Wedesin
     * @return void
     */ 
    function endorfin_enqueue_admin_scripts()
    {
        
      $addtime = filemtime( get_stylesheet_directory() . '/assets/styles/specific-css/minified/admin.css');
      wp_enqueue_style ( 'admin-css',  get_template_directory_uri() . '/assets/styles/specific-css/minified/admin.css', array(), $addtime, 'all'); 
      
      //$jgctime = filemtime( get_stylesheet_directory() . '/assets/scripts/specific-scripts/minified/admin.js');
      //wp_enqueue_style ( 'admin-js', get_template_directory_uri() . '/assets/scripts/specific-scripts/minified/admin.js', array(), $jgctime, 'all');
      
    }


    /**
     * Move scripts to the footer
     *
     * @param none
     * 
     * @author Wedesin
     * @return void
     */ 
    function wedesin_remove_head_scripts() {
      remove_action('wp_head', 'wp_print_scripts');
      remove_action('wp_head', 'wp_print_head_scripts', 9);
      remove_action('wp_head', 'wp_enqueue_scripts', 1);
    
      add_action('wp_footer', 'wp_print_scripts', 5);
      add_action('wp_footer', 'wp_enqueue_scripts', 5);
      add_action('wp_footer', 'wp_print_head_scripts', 5);
    }

    /**
     * Remove scripts where required
     *
     * @param none
     * 
     * @author Wedesin
     * @return void
     */ 
    function wpdocs_dequeue_script() {

      //prozatím deregistrovat scripty všude
      wp_dequeue_style( 'contact-form-7' );
      wp_dequeue_script( 'contact-form-7' );

      //embed na tomto webu nebude potřeba
      wp_deregister_script( 'wp-embed' );

    }
        
    /**
     * Inspect scripts
     *
     * @param none
     * 
     * @author Wedesin
     * @return void
     */ 
    function wpa54064_inspect_scripts() {
        global $wp_scripts;
        foreach( $wp_scripts->queue as $handle ) :
            echo $handle . ' | ';
        endforeach;
    }

    /**
     * Add css to footer
     *
     * @param none
     * 
     * @author Wedesin
     * @return void
     */ 
    function defer_css(  ) 
    { 
    ?>
    <script type="text/javascript">
      var url = "<?php echo get_stylesheet_directory_uri();?>";
      function c(e, m, s) {
        var l = document.createElement("link");
        l.setAttribute("rel", "stylesheet");
        l.setAttribute("media", m);
        l.setAttribute("href", e + '?hash=' + Math.random());
        document.getElementsByTagName("head")[0].appendChild(l);
      }
      
      c( url +'/assets/styles/specific-css/minified/eu-cookie-popup.css', 'screen', null);
      c( url +'/assets/styles/specific-css/minified/lazyloading.css', 'screen', null);
      c( url +'/assets/styles/specific-css/minified/lightgallery.min.css', 'screen', null);
      
    </script>
    <?php 
    }  
    
    /**
     * Add css to footer
     *
     * @param $url
     * 
     * @author Wedesin
     * @return void
     */ 
    function defer_parsing_of_js( $url ) {
      if ( is_user_logged_in() ) return $url; //don't break WP Admin
      if ( FALSE === strpos( $url, '.js' ) ) return $url;
      //if ( strpos( $url, 'jquery.js' ) ) return $url;
      return str_replace( ' src', ' defer src', $url );
    }
		
	}

}

new registerStylesScripts;