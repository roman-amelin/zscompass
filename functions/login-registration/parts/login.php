<?php

if ( !class_exists('LoginFormWed') ) {

    class LoginFormWed {

        public function __construct () {

            add_action( 'wp_login_failed', [$this,'frontend_login_fail'] );
			add_action( 'login_form_middle', [$this,'add_lost_password_link']  );
			//add_filter( 'authenticate', [$this,'authenticate_username_password'], 30, 3);

		}
		
		/**
		 * Handle error 
		 *
		 * @param none
		 * 
		 * @author Wedesin
		 * @return true/false
		 */
		function authenticate_username_password( $user, $username, $password )
		{
			if ( is_a($user, 'WP_User') ) { 
				return $user; 
			}

			if ( empty($username) && empty($password) )
			{
				$error = new WP_Error();
				$user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));

				//set session
				$session = new sessionClass();
				$session->addSession( 'login_error', 'empty_password' );

			}
		}

        /* Handle login errors
        ==================================================*/
        public function frontend_login_fail( $username ) {

        	if ( isset($_SERVER["HTTP_REFERER"]) )
				$referrer = $_SERVER["HTTP_REFERER"];
				   
           	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {

				//set session
				$session = new sessionClass();
				$session->addSession( 'login_error', true );

				//redirect
              	wp_redirect( $referrer );
              	exit;
           }

        }

        /* Forgotten password link
		==============================================================*/
   
	    function add_lost_password_link() {
	        return '<a href="'. get_permalink() .'#forgotten-password" class="forgotten-link">'.__('Zapoměli jste heslo?', TM) . '</a>';
	    }
        
        /*Login form tab
        =====================================================*/
		public function login_tab()
		
		{ 

			global $post;

			$session = new sessionClass();
			  
			//chyba přihlášení se zapomenutým heslem
			if ( $session->checkSession( 'login_error', 'success' ) ) 
			{	
				$session->message( __('Přihlášení se nezdařilo. Pokud jste zapomněli své přihlašovací údaje, můžete si v záložce 
				"Zapomenuté heslo" obnovit své přihlašovací údaje.', TM), 'alert' );
			} else if ( $session->checkSession( 'login_error', 'empty_password' ) ) {
				$session->message( __('Zadejte prosím email a heslo.', TM), 'alert' );
			//validace email, můžete se přihlásit
			} else if ( $session->checkSession( 'user_confirmation', 'success' ) ) {
				$session->message( __('Váš účet byl úspěšně verifikován. Můžete se přihlásit.', TM), 'success' );
			} else if ( $session->checkSession( 'user_confirmation', 'no-update' ) ) {
				$session->message( __('Email byl již dříve verifikován. Můžete se přihlásit.', TM), 'alert' );
			} else if ( $session->checkSession( 'user_confirmation', 'error' ) ) {
				$session->message( __('Při validaci došlo k chybě, prosím kontaktujte technickou podporu.', TM), 'alert' );
			}			

			wp_login_form( array(
				'echo'           => true,
				'remember'       => true,
				'redirect'       => $this->get_user_redirect_cookie( $post ),
				'form_id'        => 'loginform',
				'id_username'    => 'user_log',
				'id_password'    => 'user_pass',
				'id_remember'    => 'rememberme',
				'id_submit'      => 'wp-submit',
				'label_username' => __( 'Váš email', TM ),
				'label_password' => __( 'Heslo', TM ),
				'label_remember' => __( 'Zapamatovat si mě', TM ),
				'label_log_in'   => __( 'Přihlásit se', TM ),
				'value_username' => '',
				'value_remember' => false
			) ); 

		}

		/* Get redirect cookie
		=========================================================*/
		function get_user_redirect_cookie( $post )
		{

			$links  = new Links();

		    if ( isset( $_COOKIE['first-login'] ) ) { 
		    	$redirect_url = home_url() . '?login=true';
		    } else {  
				$redirect_url = $links->account_link(); 
			}

		    return $redirect_url;

		}

    }

    $LoginFormWed = new LoginFormWed();

}