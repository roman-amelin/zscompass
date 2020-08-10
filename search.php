<?php 
/**
 * The template for displaying search results pages
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */
 	

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
 	
get_header(); ?>

<?php get_template_part('parts/page', 'banner' ); ?>
				
<div class="main small-12 medium-8 large-8 cell" role="main" itemscope itemprop="mainEntityOfPage">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
		<?php get_template_part( 'parts/repeats/loop', 'archive' ); ?>
	    
	<?php endwhile; ?>	

		<?php get_template_part( 'parts/repeats/pagination'); ?>
		
	<?php else : ?>
	
		<?php get_template_part( 'parts/repeats/content', 'missing' ); ?>
			
    <?php endif; ?>

</div> <!-- end #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
