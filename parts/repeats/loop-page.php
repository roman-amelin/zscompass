<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemprop="mainContentOfPage">
											
    <section class="entry-content" itemprop="articleBody">
	    <?php the_content(); ?>
	</section> <!-- end article section -->
												    					
</article> <!-- end article -->