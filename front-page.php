<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */

get_header(); ?>
		
<div class="main cell" role="main" itemscope itemprop="mainEntityOfPage">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    	<?php get_template_part( 'parts/repeats/loop', 'page' ); ?>
    
    <?php endwhile; endif; ?>							
    					
</div> <!-- end #main -->
		    
<?php get_footer(); ?>