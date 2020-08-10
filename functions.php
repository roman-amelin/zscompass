<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

//definition
define( "TM", "zscompass");

//include
foreach( glob(get_template_directory() . "/functions/*.php") as $file ){
  require $file;
}

//include ACF fields
foreach( glob(get_template_directory() . "/functions/acf_fields/*.php") as $file ){
  require $file;
}

//custom
include_once __DIR__ . '/functions/login-registration/setup-form.php';