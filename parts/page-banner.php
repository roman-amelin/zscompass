<?php 
/**
 * The template for displaying page
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>			
<div class="top-banner ">	
	<div class="grid-container">

		<div class="grid-x grid-margin-x">

			<div class="small-12 cell">

				<section id="page-banner" >
					<div class="section section-smaller">
						<header class="entry-header text-center">
							<h1 class="entry-title" itemprop="name headline"><?php 
							if ( is_404() ) {

								echo __('Stránka neexistuje', TM );

							} else if ( is_search() ) {

								echo __('Výsledky vyhledávání', TM );

							} else if ( is_archive() ) {

								echo __('Archiv', TM );
								the_archive_description('<div class="taxonomy-description">', '</div>');

							} else {

								the_title();

							}	?></h1>

						</header>
					</div>

					
				</section>

			</div>

		</div>

	</div>
</div>