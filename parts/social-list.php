<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$fb = get_field( 'url_facebook_tip', 'options' );
/*$tw = get_field( 'url_twitter_tip', 'options' );
$in = get_field( 'url_instagram_tip', 'options' );*/

?>
<ul class="social-list menu">
	<li>
		<a href="#" title="<?php _e( 'Vyhledávání', 'tip' );?>"><?php  the_icon('lupa'); ?>
		</a>
	</li>
	<?php if (is_user_logged_in(  )) { ?>
		<li class="bg-red">
			<a href="<?php echo esc_url( wp_logout_url( home_url() )); ?>" title="<?php _e( 'Odhlášení', 'tip' );?>"><?php  the_icon('zamek'); ?></a>
		</li>
	<?php } else { ?>
		<li>
			<a href="<?php echo esc_url( wp_login_url()); ?>" title="<?php _e( 'Přihlášení', 'tip' );?>"><?php  the_icon('zamek'); ?></a>
		</li>
	<?php } ?>
	<?php if ( $fb ) : ?>
	<li>
		<a href="<?php echo $fb; ?>" target="_blank" title="<?php _e( 'Navštivte náš Facebook', 'tip' );?>"><?php the_icon('facebook'); ?>
		</a>
	</li>
	<?php endif; ?>

	<?php /* if
		<li>
		<a href="#" title="<?php _e( 'Vyhledávání', 'tip' );?>"><?php  the_icon('en-flag', 'lang-choise'); ?>
		</a>
	</li>
	
	<li>
		<a href="<?php echo $in; ?>" target="_blank" title="<?php _e( 'Přihlášení', 'tip' );?>"><?php echo file_get_contents( get_stylesheet_directory_uri(). '/src/svg/zamek.svg' ); ?>
		</a>
	</li>
	<?php if ( $fb ) : ?>
	<li>
		<a href="<?php echo $fb; ?>" target="_blank" title="<?php _e( 'Navštivte náš Facebook', 'tip' );?>"><?php echo file_get_contents( get_stylesheet_directory_uri(). '/src/svg/facebook.svg' ); ?>
		</a>
	</li>
	<?php endif; ?>

	<?php /* if ( $tw ) : ?>
	<li>
		<a href="<?php echo $tw; ?>" target="_blank" title="<?php _e( 'Navštivte náš Twitter', 'tip' );?>"><?php //echo file_get_contents( get_stylesheet_directory_uri(). '/src/svg/twitter-logo-silhouette.svg' ); ?>
		</a>
	</li>
	<?php endif; ?>
	<?php if ( $in ) : ?>
	<li>
		<a href="<?php echo $in; ?>" target="_blank" title="<?php _e( 'Navštivte náš Instagram', 'tip' );?>"><?php //echo file_get_contents( get_stylesheet_directory_uri(). '/src/svg/instagram-logo.svg' ); ?>
		</a>
	</li>
	<?php endif; */?>
</ul>