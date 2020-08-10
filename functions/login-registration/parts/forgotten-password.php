<?php

if ( !class_exists('ForgottenPasswordFormWed') ) {

    class ForgottenPasswordFormWed {

        public function __construct () {

            //handle password reset request
            add_action( 'init', [$this,'reset_user_password'] );

            //disable default password notofication email
            add_filter( 'send_password_change_email', [$this,'__return_false'] );

        }

        /* function for forgotten password
		=============================================*/
		public function forgotten_tab(){ 

            $session = new sessionClass;
            $query_post = filter_input_array(INPUT_POST);
            $user_login = isset( $query_post['user_login'] ) ? $query_post['user_login'] : ''; 

            if ( $session->checkSession( 'forgotten_request', 'success' ) ) {
				$session->message( __('Odeslali jsme vám email s novým heslem. Koukněte se prosím do schránky.', TM), 'success' );
            } else if ( $session->checkSession( 'forgotten_request', 'empty' ) ) {
				$session->message( __('Vyplnili jste pole, které mělo zůstat prázdné.', TM), 'alert' );
            } else if ( $session->checkSession( 'forgotten_request', 'error' ) ) {
				$session->message( __('Tuto žádost jsme nedokázali verifikovat.', TM), 'alert' );
            } else if ( $session->checkSession( 'forgotten_request', 'empty_email' ) ) {
				$session->message( __('Nevyplnili jste pole emailu.', TM), 'alert' );
            } else if ( $session->checkSession( 'forgotten_request', 'empty_wrong' ) ) {
				$session->message( __('Zadaný email není správný.', TM), 'alert' );
            } else if ( $session->checkSession( 'forgotten_request', 'empty_unknown' ) ) {
				$session->message( __('Tento email v databázi nemáme.', TM), 'alert' );
            }  
            
            //TADY TEN FORMULÁŘ SE NECHCE POSÍLAT, KDYŽ JE TAM ABIDE PŘIDANÉ. NETUŠÍM PROČ, 

            /*
            toto do app.js a spoušít to jednotlivé actions

            $("#forgotten-form").on('submit', function() {
            //console.log("submit triggered");
            //return false;
            });

            $("#forgotten-form").on('invalid.zf.abide', function() {
            console.log("invalid.zf.abide triggered");
            });

            $("#forgotten-form").on('valid.zf.abide', function() {
            console.log("valid.zf.abide triggered");
            $("#forgotten-form").submit();
            return false;
            // ajax post.
            });
            
            */
            ?>
            <p class="entry-title">
                <?php _e('Prosím vyplňte svůj email. Emailem obdržíte nově vygenerované heslo. ', TM); ?>
            </p>
            <form method="post" id="forgotten-form" action="" <?php //novalidate data-abide ?>>
                <?php wp_nonce_field( 'forgotten_nonce_action', 'forgotten_nonce' );?>
                <input type="hidden" name="password_reset" value="1" />
                <div class="hide ">
                    <input type="hidden" value="" name="username">
                </div>
                <div data-abide-error class="alert callout" style="display: none;">
                    <p><i class="fi-alert"></i> There are some errors in your form.</p>
                </div>
                <p>
                    <input type="text" name="user_login" id="user_login" value="<?php echo $user_login; ?>" <?php /*required pattern="email"*/ ?> >
                    <span class="form-error" data-form-error-on="email">
                        <?php _e("Zadejte platnou emailovou adresu", TM) ;?>
                    </span>
                </p>
                <input type="submit" value="<?php _e("Vyžádat heslo", TM) ?>" class="button" id="submit" />
            </form>		
        <?php 
		}        

		/* Reset login password
        ===================================================*/
        public function reset_user_password() {

            global $reset_errors;
            $reset_errors = new WP_Error;

            $query_post = filter_input_array(INPUT_POST);

            if ( $query_post ) {
                
                $session = new sessionClass;

                if( isset($query_post['forgotten_nonce']) && wp_verify_nonce( $query_post['forgotten_nonce'], 'forgotten_nonce_action' ) ) {
                    
                    if ( $query_post['username'] == "" ) {

                        $email = $query_post['user_login'];

                        //validate all emails
                        if( isset( $query_post['password_reset'] ) && 1 == $query_post['password_reset'] ) {

                            if ( empty( $email ) ) {

                                $session->addSession( 'forgotten_request', 'empty_email' );
                                                                
                            } else if( !is_email( $email )) {

                                $session->addSession( 'forgotten_request', 'empty_wrong' );
                                
                            } else if( !email_exists( $email ) ) {

                                $session->addSession( 'forgotten_request', 'empty_unknown' );

                            //we are good to go    
                            } else {

                                $random_password = wp_generate_password( 12, false );
                                $user = get_user_by( 'email', $email );
                                
                                $update_user = wp_update_user( array(
                                        'ID' => $user->ID, 
                                        'user_pass' => $random_password
                                    )
                                );

                                //send mail from here
                                $email_class = new fleraSendEmail();
                                $subject = __( 'Vygenerování nového hesla', TM );
                                $message = 'Naše nové heslo je: ' . $random_password;
                                $email_class->send_client_emails( $email, $subject, $message );

                                //set message data
                                $session->addSession( 'forgotten_request', 'success' );

                            }

                        } 
                        //redirect back
                        redirect_back( "#forgotten" );

                    } else {
                        $session->addSession( 'forgotten_request', 'empty' );
                        //redirect back
                        redirect_back( "#forgotten" );
                    }                    

                }

            }

        }

    }

    $ForgottenPasswordFormWed = new ForgottenPasswordFormWed();

}

?>