<?php 
/**
 * Adds a light gallery functionality to the theme
 *
 *
 * @author Wedesin
 */ 

if ( ! defined( 'ABSPATH' ) ) {

  exit;

}

global $light_gallery;

if( ! class_exists( 'LightGallery' ) )
{

	class LightGallery

	{

		public function __construct( $imgArray, $buttonname )
		{

			//get construct variables
			$this->imgarray  =  $imgArray;
			$this->buttonname  =  $buttonname;
			//register scripts
			add_action( 'wp_enqueue_scripts', [$this, 'endorfin_enqueue_admin_scripts'] );
			
			add_action( 'wp_footer', [$this, 'footer_activation_gallery'] );

		}

		/**
		* 	Define templates, if required 
		*
		* 	@author Wedesin
		* 	@return hook
		*/
		function is_template(  ) {

			if ( is_singular() ) 
				return true;
			else 
				return false;
			
		}

		/**
		* 	Register all scripts 
		*
		* 
		* 	@author Wedesin
		* 	@return hook
		*/
		function endorfin_enqueue_admin_scripts(){

			if ( $this->is_template( ) ) {

				//register scripts
			    $lightjs = filemtime( get_stylesheet_directory() . '/assets/scripts/specific-scripts/lightgallery-all.min.js');
			    wp_enqueue_script ( 'lightgallery', get_stylesheet_directory_uri() . '/assets/scripts/specific-scripts/lightgallery-all.min.js', array("jquery", "global"), $lightjs, true); 
		      	wp_enqueue_script ( 'picturefill.min', get_stylesheet_directory_uri() . '/assets/scripts/specific-scripts/minified/picturefill.min.js', array("jquery", 'lightgallery', 'global'), '', true);
		      	wp_enqueue_script ( 'jquery.mousewheel', get_stylesheet_directory_uri() . '/assets/scripts/specific-scripts/minified/jquery.mousewheel.min.js', array("jquery", 'lightgallery', 'global'), '', true); 

		    }

		}

		/**
		* 	create public button hook 
		*
		* 
		* 	@author Wedesin
		* 	@return string if parameters are set, false if not
		*/
		public function button( $text, $class="" ){

			if ( !empty( $text ) ) {
				return '<a href="" id="'.$this->buttonname.'" '.( !empty( $class )? 'class="'.$class.'"' : '' ).'>' . $text . '</a>';				
			} else {
				return false;
			}
				
		}

		/**
		* 	activate gallery 
		*
		* 
		* 	@author Wedesin
		* 	@return hook
		*/
		public function footer_activation_gallery( ){ 

			if ( $this->is_template( ) && !empty( $this->imgarray ) ) { ?>
			<script type="text/javascript">
				(function( $ ) {

					$(document).ready(function(){

						$('#<?php echo $this->buttonname; ?>').on('click', function(e) {

							e.preventDefault();
 
						    $(this).lightGallery({
						        dynamic: true,
						        dynamicEl: [<?php 

						        $ctr = 1;
						        foreach ($this->imgarray as $img ) {

						        	echo "{
							            'src': '".$img['src']."',
							            'thumb': '".$img['thumb']."',
							            'subHtml': '". str_replace( "'", "", $img['subHtml'] ) ."'
							        }";

							        if ( count($this->imgarray) > $ctr ) echo ','; 
							        $ctr++;
						        
						        }

						        ?>]
						    });
						 
						});


					});

				})(jQuery);
				
			</script>
		<?php }

		}

	}

}

new LightGallery('', '');