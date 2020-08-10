<?php
/**
 * The main template file
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// check if the repeater field has rows of data
if( have_rows('end_slidy') ):

	echo '<div class="top-slider section">';

 	// loop through the rows of data
    while ( have_rows('end_slidy') ) : the_row();

        // display a sub field value
        $img_url = get_sub_field('end_pozadi_slidu');
        /*$text_sub = get_sub_field('text_slidu');*/

        echo '<div style="background: #fff url('. wp_get_attachment_image_src( $img_url, 'full' )[0] .') no-repeat; background-size: 100% auto; background-size: cover;background-position: center;">';  

        echo '</div>';

    endwhile;

    echo '</div>';

endif;

?>