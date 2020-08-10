<?php 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

?>
    
<div id="subfooter" class="section section-tiny">
    
  <div class="grid-container">
    
    <div class="grid-x grid-margin-x">
      
      <aside class="large-3 medium-3 cell" itemscope itemtype="http://schema.org/WPSideBar"> 
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1')) : ?>
                      
        <?php endif; ?> 
      </aside>
      
      <aside class="large-5 medium-5 cell" itemscope itemtype="http://schema.org/WPSideBar"> 
        <?php /*if (!function
        _exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2')) : ?>           
        <?php endif; */
        $address = get_field( 'address_zsc', 'options' );
        $phone = get_field( 'phone_zsc', 'options' );
        $mail = get_field( 'mail_zsc', 'options' );
        ?> 
        <div class="widget footer-widget" id="widget-contact">
          <p class="h3"><?= __('Kontakt', TM)?></p>
          <div class="menu-footer-menu-container">
            <ul class="menu">
              <?php if ( $address ) : ?>
                <li id="menu-item-19" class="with-icon icon-pin"> 
                  <a href=""><?=$address ?></a>
                </li>
              <?php endif; ?>
              <?php if ( $phone ) : ?>
                <li id="menu-item-20" class="with-icon icon-phone">
                  <a href="<?= 'tel:'.$phone ?>"><?= $phone ?></a>
                </li>
              <?php endif; ?>
              <?php if ( $mail ) : ?>
                <li id="menu-item-20" class="with-icon icon-mail">
                  <a href="<?= 'mailto'.$mail ?>"><?= $mail ?></a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </aside>
      
      <aside class="large-4 medium-4 cell" itemscope itemtype="http://schema.org/WPSideBar"> 
        <?php /*if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3')) : ?>
                      
        <?php endif;*/ ?> 
        <div class="cta-register">
          <div class="register-wrap">
            <div class="register-text">
              <?= __('Zaujala vás naše škola?',TM)?>
            </div>
            <a href="#" class="button"><?= __('Přihlásit se k zápisu', TM) ?></a>
            </div>
          
        </div>
      </aside>
      
    </div>

  </div>

</div>

