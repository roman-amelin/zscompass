<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
  }
  

get_header(); ?>

<?php get_template_part('parts/page', 'banner' ); ?>
		
<div class="grid-container">

	<div class="grid-x grid-margin-x">

		<div class="main small-12 large-8 medium-8 cell" role="main" itemscope itemprop="mainEntityOfPage">

		<?php get_template_part('parts/breadcrumbs'); ?>
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'parts/repeats/loop', 'page' ); ?>
			
			<?php endwhile; endif; ?>		

			<p>hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br></p>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
			hjkdhjlkdhdsjkldhsjlkshfdjklshjlskd<br>					
								
		</div>

	</div>

</div>	
		    
<?php get_footer(); ?>