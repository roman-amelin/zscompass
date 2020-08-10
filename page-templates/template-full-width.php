<?php
/*
Template Name: Full Width (No Sidebar)
*/

get_header();
$fields = get_fields();
 ?>
	
	<?php get_template_part('parts/page', 'banner' ); ?>
			
	<div class="content">
		<div class="section section-small section-top relative">
			<?php if (isset($fields['bubble_green']) && $fields['bubble_green']) { ?>
			
				<div class="bubble bubble-green">
					<div class="bubble-content content-big">
						<?= $fields['bubble_green'] ?>
					</div>
				</div>
			<?php } ?>
			<div class="grid-container">
		
				<div class="inner-content grid-x grid-margin-x">
			
					<main class="main small-12 medium-12 large-12 cell" role="main">
						
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php get_template_part( 'parts/repeats/loop', 'page' ); ?>
							
						<?php endwhile; endif; ?>	
						<?php 
						// Check rows exists.
						if( have_rows('circle_text_rep') ): 
						$ct=1;?>
							<div class="section section-large">
								<?php if ($fields['section_circle_title']) { ?>
									<div class="section section-bottom section-smaller">
										<h3 class="text-center"><?= $fields['section_circle_title'] ?></h3>
									</div>
								<?php } ?>
								<div class="section-circle">
									<?php while( have_rows('circle_text_rep') ) : the_row();
										// Load sub field value.
										$circle_text = get_sub_field('circle_text');
										if ($circle_text) { ?>
											<div class="circle-wrap">
												<div class="circle-object <?= 'circle'.$ct?>">
												<div class="circle-text-wrap h2">
													<?= $circle_text ?>
												</div>
												</div>
											</div>
											<?php 
											$ct++;
										} ?>

									<?php endwhile; ?>		
								</div>
							</div>
						<?php endif;
						?>				

					</main> <!-- end #main -->
					
				</div> <!-- end #inner-content -->
			</div>

			<?php if (isset($fields['bg_image']) && isset($fields['content_bubble']) && $fields['bg_image'] && $fields['content_bubble']) { ?>
				<section class="relative">
					<?php if (isset($fields['bubble_orange']) && $fields['bubble_orange']) { ?>
						<div class="bubble bubble-orange">
							<div class="bubble-content content-big">
								<?= $fields['bubble_green'] ?>
							</div>
						</div>
					<?php } ?>
					
					<div class="centered-bubble">
						<div class="bubble bubble-large bubble-white">
							<div class="bubble-content">
								<h3><?php echo $fields['title_bubble']; ?></h3>
								<p><?php echo $fields['content_bubble']; ?></p>
							</div>
						</div>
					</div>		
				<div class="image-bg" style="background-image: url(<?=$fields['bg_image']['url'] ?>)">
				</section>	
				</div>	
			<?php } ?>	
		</div>
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
