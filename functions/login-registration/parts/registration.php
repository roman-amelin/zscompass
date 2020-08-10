<?php

if ( !class_exists('RegistrationFormWed') ) {

    class RegistrationFormWed {

        public function __construct () {

            //add_action( 'wp_login_failed', [$this,'frontend_login_fail'] );
            add_action( 'init', [$this,'account_verification'] );
            add_action( 'init', [$this, 'complete_name_filling_form'] );
            //form shortcode
            add_shortcode( 'registration', [ $this, 'registration_form' ] );

        }

        /* Create registration tab
        =============================================*/
        public function registration_form(){

            $session = new sessionClass;
            $cookies = new Cookies;

            if ( $session->checkSession( 'user_registration', 'success' ) ) {
				$session->message( __('Úspěšně jste se zaregistrovali. Přejděte do svého emailu, kam vám přišel potvrzující email s odkazem.', TM), 'success' );
            } else if ( $session->checkSession( 'user_registration', 'empty_email' ) ) {
                $session->message( __('Vyplňte prosím email.', TM), 'alert' );
            } else if ( $session->checkSession( 'user_registration', 'password_short' ) ) {
                $session->message( __('Heslo musí mít alespoň 8 znaků', TM), 'alert' );
            } else if ( $session->checkSession( 'user_registration', 'password_empty' ) ) {
                $session->message( __('Vyplňte prosím heslo.', TM), 'alert' );
            } else if ( $session->checkSession( 'user_registration', 'email_wrong' ) ) {
                $session->message( __('Zkontrolujte vyplněný email', TM), 'alert' );
            } else if ( $session->checkSession( 'user_registration', 'email_known' ) ) {
                $session->message( __('Tento email již známe. Přihlašte se prosím na záložce "Přihlášení".', TM), 'alert' );
            }   
            
        ?>
            <div id="registration-form">

                <form action="<?php echo get_permalink(); ?>" method="post" data-abide novalidate>

                    <div class="hide">
                        <input type="text" name="email" value="">
                    </div>

                    <p><?=__('Zadejte prosím váš přihlašovací email a heslo. Do emailové schránky vám přijde email, pro potvrzení vašeho účtu', TM); ?>
                    <?php 
                    wp_nonce_field( 'reg_nonce_action_1', 'register_nonce_1' );        
                    $email = $cookies->Get('_registration_email');         
                    ?>
                    <p>
                        <label><?php _e('Váš email', TM ); ?> <span class="blue-text">*</span></label> 
                        <input type="text" name="our_email" value="<?=$email?>" required pattern="email">
                        <span class="form-error" data-form-error-on="pattern">
                            <?php _e('Email není platný', TM );?>
                        </span>
                    </p> 
                    <p>
                        <label for="password"><?php _e('Vaše heslo (minimální délka 8 znaků)', TM); ?> <span class="blue-text">*</span></a></label> 
                        <input type="password" name="password" value="" id="password1" autocomplete="off" required>
                        <span class="form-error" data-form-error-on="required">
                            <?php _e('Toto pole je vyžadované', TM );?>
                        </span>
                    </p>
                    <p>
                        <fieldset class="cell large-6">
                            <input type="checkbox" name="pokemon" value="Red" id="pokemonRed" required><label for="pokemonRed"><?php _e('Souhlasím se správou osobních údajů', TM); ?></label>
                        </fieldset>
                    </p>
                    <input type="submit" class="button" value="<?php _e('Registrovat', TM);?>">
                </form>

            </div>    

        <?php }

        /**
         * Začne
         *
         * @param none
         * 
         * @author Wedesin
         * @return true/false
         */ 
        public function complete_name_filling_form() {   

            $query = filter_input_array(INPUT_POST);     

            if ( !empty($query) ) {

                if( isset($query['register_nonce_1']) && wp_verify_nonce( $query['register_nonce_1'], 'reg_nonce_action_1' ) ) {


                    //email validation
                    if ( !empty( $query['email'] ) ) {
                        return false;
                    } 

                    //vytvoření uživatelského jména
                    $email = sanitize_text_field( $query['our_email'] );
                    $password = sanitize_text_field( $query['password'] );
                    $username = $this->concentate_username( $email );
                    //set cookies
                    $cookies = new Cookies;
                    $cookies->Set( [
                        'name' => '_registration_email',
                        'expire' => CL,
                        'value' => $email
                    ] );

                    //validate fields
                    if ( $this->registration_step_one_validation( $username, $email, $password ) )  { 
                        //success redirect
                        $this->complete_registration_form($username, $email, $password );
                    }

                }  
                
            }

            return false;

        }

        /* Function to complete registration form
        =================================================*/
        public function complete_registration_form($username, $reg_mail, $reg_pass) {       

            $userdata = array(
                'user_login' => $username,
                'user_email' => $reg_mail,
                'user_pass'  => $reg_pass,
                'first_name' => sanitize_text_field( $query['fname'] ),
                'last_name'  => sanitize_text_field( $query['lname'] ),
                'role' => 'unconfirmed_client'
            );
                
            $user = wp_insert_user( $userdata );

            if ( !is_wp_error( $user ) ){

                //update user metadata
                update_user_meta( $user, 'terms-conditions', 1 );

                /* Send confirmation email
                ==================================================*/
                $user_info = get_userdata($user);

                if (  $user_info->user_email && $user ) {
                    $to = $reg_mail;
                    $activation_url = wp_nonce_url( home_url() . '/?request_account_verification=1&user=' . $user . '', 'account_verification_action', 'account_verification_name');
                    $class_email = new fleraSendEmailContent();
                    $class_email->email_registration($to, $user, $activation_url);

                    //set message data
                    $session = new sessionClass;
                    $session->addSession( 'user_registration', 'success' );

                    //remove cookies
                    $cookies = new Cookies;
                    $cookies->Delete('_registration_email');

                    //redirect
                    redirect_back("#registration");
                } 

            } 
        }           

        //validate step one of the registration process
        public function registration_step_one_validation( $username, $email, $password )  {

            $session = new sessionClass();

            if ( empty( $email ) ) {
                            
                $session->addSession( 'user_registration', 'empty_email' );
                redirect_back("#register");
                    
            }

            //password validation
            if ( !empty( $password ) ) { 
            
                if ( 7 >= strlen( $password ) ) {

                    $session->addSession( 'user_registration', 'password_short' );
                    redirect_back("#register");
                      
                } 

            } else {

                $session->addSession( 'user_registration', 'password_empty' );
                redirect_back("#register");

            }

            if ( !is_email( $email ) ) {

                $session->addSession( 'user_registration', 'email_wrong' );
                redirect_back("#register");

            }

            if ( email_exists( $email ) ) {

                $session->addSession( 'user_registration', 'email_known' );
                redirect_back("#register");

            }

            return true;
        }

        
        /* Return new usermane
        =====================================================*/
        private function concentate_username( $email ) {
        global $wpdb;
        $conformity = 1;
        $user_name = strstr($email, '@', true); // As of PHP 5.3.0
            if ($this->check_exist_user_name($user_name) == true) {

                while($this->check_exist_user_name( $user_name . $conformity) == true) {
                    $conformity++;
                }
                $user_login = $user_name . $conformity;
            } else {
                $user_login = $user_name;
            }

            return $user_login;
        }
        /* Return if usermane exist
        =====================================================*/
        function check_exist_user_name($user_name){
            $users = get_users(array( 'fields' => array( 'display_name' ) ) );
            $conformity = 0;
            foreach ( $users as $user ) {
                if ($user_name == $user->display_name ) $conformity++;
            }
            if ( $conformity > 0) {
                return true;
            } else {
                return false;
            }
        }

        /*
        * rerify the user when he registers
        =================================*/
        public function account_verification(){

            $filter = filter_input_array(INPUT_GET);

            if ( !empty( $filter ) ) {

                //check nonce
                if (!isset($filter['my_nonce']) || !wp_verify_nonce($filter['account_verification_name'], 'account_verification_action') ) {

                    if ( isset( $filter['request_account_verification'] ) && $filter['request_account_verification'] == 1 && !empty( $filter['user'] ) ) {

                        $session = new sessionClass;
                        $reg = new custom_login_form_wed;

                        $user_meta=get_userdata( $filter['user'] );
                        $user_roles=$user_meta->roles;
                        $role = 'client';

                        //pokud už účet je verifikovaný
                        if ( is_array( $user_roles ) && in_array( $role,  $user_roles  )  ) {

                            //set session for no update
                            $session->addSession( 'user_confirmation', 'no-update' );

                        } else {

                            //get user role                            
                            $user_id = wp_update_user( array( 'ID' => $filter['user'], 'role' =>  $role ) );

                            //there is an error
                            if ( is_wp_error( $user_id ) ) {

                                //set session for no update
                                $session->addSession( 'user_confirmation', 'error' );
                                
                            //all si well
                            } else {
                                $session->addSession( 'user_confirmation', 'success' );              
                            }

                        }

                        //redirect to login page
                        wp_redirect( $reg->get_login_registration_url() );
                        exit; 

                    }

                } 
                
                return false;
                
            }

        }

    }

    $RegistrationFormWed = new RegistrationFormWed();

}