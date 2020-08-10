<?php 
/**
 * The sidebar containing the main widget area
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
?>
<aside class="sidebar small-12 medium-4 large-4 cell" itemscope itemtype="http://schema.org/WPSideBar">

	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets')) : ?>
       		
  <?php endif; ?> 
  
</aside>