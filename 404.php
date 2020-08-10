<?php
/**
 * The template for displaying 404 (page not found) pages.
 *
 * For more info: https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header(); ?>
			
<?php get_template_part('parts/page', 'banner' ); ?>
	
<div class="main small-12 medium-8 large-8 cell" role="main" itemscope itemprop="mainEntityOfPage">

	<article class="content-not-found">
	
		<div class="entry-content">
			<p><?php _e( 'Hledaná stránka neexistuje. Zkuste jí vyhledat níže!', TM ); ?></p>

			<p><?php get_search_form(); ?></p>
		</div>

	</article> 

</div> 

<?php get_footer(); ?>