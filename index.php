<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */


if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

get_header(); ?>
			
<?php get_template_part('parts/page', 'banner' ); ?>
	
<div class="main small-12 medium-8 large-8 cell" role="main" itemscope itemprop="mainEntityOfPage">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 
		<!-- To see additional archive styles, visit the /parts directory -->
		<?php get_template_part( 'parts/repeats/loop', 'archive' ); ?>
	    
	<?php endwhile; ?>	

		<?php get_template_part( 'parts/repeats/pagination'); ?>
		
	<?php else : ?>
								
		<?php get_template_part( 'parts/repeats/content', 'missing' ); ?>
			
	<?php endif; ?>
																					
</div> <!-- end #main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>