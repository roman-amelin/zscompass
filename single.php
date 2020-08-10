<?php 
/**
 * The template for displaying all single posts and attachments
 */


if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

get_header(); ?>

<?php get_template_part('parts/page', 'banner' ); ?>
			
<div class="main small-12 medium-8 large-8 cell" role="main" itemscope itemprop="mainEntityOfPage">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    	<?php get_template_part( 'parts/repeats/loop', 'single' ); ?>
    	
    <?php endwhile; else : ?>

   		<?php get_template_part( 'parts/repeats/content', 'missing' ); ?>

    <?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>