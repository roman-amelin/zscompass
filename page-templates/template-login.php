<?php
/*
Template Name: Přihlášení
*/

get_header(); 

get_template_part('parts/page', 'banner' ); 

?>

<div class="section">

	<div class="grid-container">

		<div class="grid-x">

			<div class="main large-6 medium-10 small-12 large-offset-3 medium-offset-1 cell" role="main" itemscope itemprop="mainEntityOfPage">

                <section class="section">
                    <?php 

                    if ( !is_user_logged_in(  ) ) {

                        echo do_shortcode( '[login-form]');
                        
                    } else {

                        echo _('Už jste přihlášení, přejděte do svého účtu.');

                        echo '<a href="'. wp_logout_url( get_permalink( ) ) .'" class="button">'.__('Odhlásit se', TM).'</a>';
                    }
                        
                    ?>
                </section>	
                		           
            </div>

        </div>

	</div>

</div>

<?php get_footer(); ?>