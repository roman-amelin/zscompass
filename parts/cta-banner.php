<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
$img1 = get_field( 'partner_logo_1', 'options' );
$height1 = get_field( 'partner_logo_height_1', 'options' );
$link1 = get_field( 'partner_link_1', 'options' );

$img2 = get_field( 'partner_logo_2', 'options' );
$height2 = get_field( 'partner_logo_height_2', 'options' );
$link2 = get_field( 'partner_link_2', 'options' );

$img3 = get_field( 'partner_logo_3', 'options' );
$height3 = get_field( 'partner_logo_height_3', 'options' );
$link3 = get_field( 'partner_link_3', 'options' );
?>
<style>
#cta-banner .img-height1 {
    height: <?= $height1.'px'; ?>;
    margin-left: 42px;
}
#cta-banner .img-height2 {
    height: <?= $height2.'px'; ?>;
    margin-left: 42px;
}
#cta-banner .img-height3 {
    height: <?= $height3.'px'; ?>;
    margin-left: 42px;
}
</style>
<div id="cta-banner">
    <div class="grid-container copyright">
		<div class="grid-x grid-margin-x">
			<div class="cell">
                <div class="section section-small">
                    <div class="flex">
                        <h3><?= __('Spolupracujeme', TM) ?><h3>
                        <a href="<?= $link1['url'] ?>">
                            <img class="img-height1" src="<?= $img1['url']?>" alt="<?= esc_attr($img1['alt']); ?>" target="<?php echo ($link1['target'] ? $link1['target'] : '_self') ?>">
                        </a>
                        <a href="<?= $link2['url'] ?>">
                            <img class="img-height2" src="<?= $img2['url']?>" alt="<?= esc_attr($img2['alt']); ?>" target="<?php echo ($link2['target'] ? $link2['target'] : '_self') ?>">
                        </a>
                        <a href="<?= $link3['url'] ?>">
                            <img class="img-height3" src="<?= $img3['url']?>" alt="<?= esc_attr($img3['alt']); ?>" target="<?php echo ($link3['target'] ? $link3['target'] : '_self') ?>">
                        </a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>