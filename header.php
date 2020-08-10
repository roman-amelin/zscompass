<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

//define language class
if ( is_lang('en') ) {  
	$class = "english";
} else { 
	$class = "czech"; 
} 

?>
<!doctype html>

<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js" async defer></script>
	<script>
		//no-js
		document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/g, '') + ' js ';
		//webfont
		WebFontConfig = {
			google: { families: ['Open+Sans:400:latin,latin-ext'] },
			active: function() { document.cookie ='wfont=1; expires='+(new Date(new Date().getTime() + 86400000)).toGMTString()+'; path=/' }
		};
	</script>
	<?php wp_head(); ?>
</head>			
<body <?php 

body_class( $class ); 

switch (true) {
	case is_single():
		echo 'itemscope itemtype="http://schema.org/BlogPosting"';
		break;
	
	default:
		echo 'itemscope itemtype="http://schema.org/WebPage"';
		break;
}
?>>
<div id="panel" class="panel slideout-panel slideout-panel-right">

	<button class="js-slideout-toggle linear-animation">
        <span class="top-row"></span>
        <span class="middle-row"></span>
        <span class="bottom-row"></span>
    </button>

	<noscript>Tato webová stránka nefunguje bez Javascriptu. Prosím, zapněte jej</noscript>
				
	<header id="header" itemscope itemtype="http://schema.org/WPHeader">
		
		<div class="grid-container full">
			
			<div class="grid-x grid-margin-x">

				<div class="small-12 medium-3 large-3 cell relative">
					<div class="logo-wrap">
					<a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/svg/Logo.svg'?>" alt="<?php bloginfo('name'); ?>"></a>
					</div>
				</div>
				
				<div class="small-12 medium-9 large-9 cell">
					<?php get_template_part( 'parts/social', 'list');  ?>
					<div class=" show-for-medium">
						<?php wp_nav_menu(array(
							'container' => false,                           // Remove nav container
							'menu_class' => 'medium-horizontal menu align-right',       // Adding custom nav class
							'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
							'theme_location' => 'primary',        			// Where it's located in the theme
							'depth' => 5,                                   // Limit the depth of the nav
							'fallback_cb' => false,                         // Fallback function (see below)
							'walker' => new Topbar_Menu_Walker()
						)); ?>	
					</div>
					
				</div>
			</div>

		</div>

	</header>
<?php $bannerColor = get_field('choice_color'); ?>
	<main id="main-content" class="<?= $bannerColor ?>">