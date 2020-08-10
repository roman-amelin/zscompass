<?php
/**
 * The template for displaying the footer. 
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */		


if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

?>
</main>		
<?php get_template_part( 'parts/cta', 'banner' ); ?>
		<footer id="footerwrap"  class="footer footer-nav" itemscope itemtype="http://schema.org/WPFooter">
				
			<?php get_template_part( 'parts/sub', 'footer' ); ?>

			<div class="grid-container copyright">
				<div class="grid-x grid-margin-x">
					<div class="cell">
						<div class="section section-tiny bor-top"></div>
					</div>
						
					<div class="large-3 medium-3 cell">	
						<div class="section section-small section-bottom">
							<?php bloginfo('name'); echo ' ' . __('Copyright', TM). ' ' . date('Y');?>
						</div>
					</div>
					<div class="large-6 medium-6 cell">	
						<div class="section section-small section-bottom">
							<?php 
							wp_nav_menu ( 
								array( 'theme_location' => 'footer', 'items_wrap' => '<ul class="footer-menu menu ">%3$s</ul>')
							); 
							?>
						</div>
					</div>
					<div class="large-3 medium-3 cell text-right">	
						<div class="section section-small section-bottom">
							<a href="https://www.wedesin.cz/" rel="noreferrer" target="_blank" title="<?php _e('Navštivte WeDesIn', TM) ;?>"><?php _e('Vytvořil WeDesIn',TM ); ?></a>	
						</div>			
					</div>
				</div>
			</div>					
							
		</footer>
			
		<div class="eupopup eupopup-container-bottom"></div>
	</div>
	<div id="menu" class="menu slideout-menu">

		<button class="close-button" aria-label="Close side menu" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

		<p class="h4"><?php _e('Navigace', TM); ?></p>
			
		<?php wp_nav_menu ( array( 'theme_location' => 'primary', 'items_wrap' => '<nav><ul id="mobile-menu" class="linear-animation">%3$s</ul></nav>')); ?>

	</div>
		<?php wp_footer(); ?>
		
	</body>
	
</html> <!-- end page -->