<?php 
/**
 * The template for displaying single posts content
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article class="hentry" itemscope itemtype="http://schema.org/Article">

	<header class="entry-header">
		<h1 class="entry-content"><?php the_title() ?></h1>
	</header>

	<section class="entry-content" itemprop="articleBody">
		<?php the_excerpt() ?>
	</section>


</article>

<?php if (is_user_logged_in()) { ?>	
	<div class="edit">
		<span class="edit-link"><?php edit_post_link( "Edit" ); ?></span>
	</div>
<?php } ?>