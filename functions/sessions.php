<?php 
/**
 * class description
 *
 * 
 * @author Wedesin
 */ 

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'sessionClass' ) )
{
	class sessionClass
	{

		public function __construct()
		{
			
			//init session
            add_action('init',  [$this,'start_session'], 1);
            //add_action('wp_logout', [$this,'end_session']);
            //add_action('wp_login', [$this,'end_session']);

            //prozatím ničím všechny session, uvidíme, jestli to bude něčím vadit...
            add_action( 'wp_footer', [$this,'end_session'], PHP_INT_MAX );

        }

        /**
         * Otevření všech session
         * 
         * @author Wedesin
         * @return true/false
         */ 
        function start_session( ) 
        {
            if(!session_id()) {
                session_start();
            }
        }

        /**
         * Smazání všech session
         *
         * 
         * @author Wedesin
         * @return true/false
         */ 
        function end_session() 
        {
            if(session_id()) {
                session_destroy ();
            }

        }

        /**
         * Vytvoření session
         *
         * @param $name = jméno session
         * @param $value = hodnota
         * 
         * @author Wedesin
         * @return true/false
         */ 
        public function addSession( $name, $value="" ) 
        {
            $_SESSION[$name] = $value;
            return true;
        }

        /**
         * Kontrola session
         *
         * @param $name = jméno session
         * @param $value = hodnota
         * 
         * @author Wedesin
         * @return true/false
         */ 
        public function checkSession( $name, $value="" ) 
        {
            
            if ( isset( $_SESSION[$name] ) ) 
            {

                if ( $value !== "" ) 
                {

                    if ( $_SESSION[$name] == $value ) 
                    {
                        return true;
                    }                    

                } else {

                    if ( $_SESSION[$name] == 'error' ) 
                    {

                        return true;

                    } else {
                        
                    }

                }

            }

            return false;

        }


        /**
         * Kontrola session
         *
         * @param $content = jméno session
         * @param $class = třída
         * @param $btn_link = odkaz tlačítka
         * @param $btn_text = text tlačítka
         * 
         * @author Wedesin
         * @return true/false
         */ 

        public function message( $content, $class="", $btn_link="", $btn_text="" ) 
        { 
            $has_button = false;
            if ( $btn_link && $btn_text ) {
                $has_button = true;
            }
        ?>
        <div class="callout <?php echo  $class; ?>">
            <div class="grid-x grid-margin-x">
                <div class="medium-<?php if ( $has_button ) echo "8"; else echo "12"; ?> cell">
                    <?php echo $content; ?>
                </div>
                <?php if ( $has_button ) { ?>
                <div class="medium-4 cell medium-text-right">
                    <a href="<?php echo $btn_link; ?>" class="button no-margin">
                        <?php echo $btn_text; ?>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php 
        }
        
	}

}

new sessionClass;


?>