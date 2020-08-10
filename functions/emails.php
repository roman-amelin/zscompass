<?php 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
wraps email body into prestyled html content
==============================================================*/
if ( !function_exists('email_content_end') ) {

  function email_content_end( $title, $body, $button_link = "", $button_text = "" ){

   $return ='<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>'.$title.'</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        margin: 0 auto !important;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        display: block;
        margin: 0 auto !important;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        padding-bottom: 20px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        padding-bottom: 5px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px;
          margin-bottom: 5px; }

      a {
        color: #cdb48f;
        text-decoration: underline; }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #cdb48f;
          border-radius: 5px;
          box-sizing: border-box;
          color: #cdb48f;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #cdb48f; }

      .btn-primary a {
        background-color: #cdb48f;
        border-color: #cdb48f;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #cdb48f !important;
          color: #fff !important; }
        .btn-primary a:hover {
          background-color: #cdb48f !important;
          border-color: #cdb48f !important;
          color: #fff !important;

        } }

    </style>
  </head>
  <body class="">
    <table border="0" bgcolor="#f6f6f6" cellpadding="0" cellspacing="0" class="body" style="background-color: #f6f6f6; width: 100%;">
      <tr>
        <td>&nbsp;</td>
        <td class="container" style="display: block; margin: 0 auto !important;  Margin: 0 auto !important; max-width: 580px; padding: 10px; width: 580px; ">
          <div class="content" style="display: block; margin: 0 auto !important; Margin: 0 auto; max-width: 580px;  padding: 10px;">

            <table class="main" style=" background: #ffffff;  border-radius: 3px;  width: 100%; ">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style=" background: #ffffff;  border-radius: 3px;  width: 100%; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                      <tr>
                          <td width="500" align="center"><a href="http://endorfin.cz/" target="_blank" style="text-decoration: none; color: #BDBDBD;"><img alt="Endorfin" src="http://endor.wedev.cz/wp-content/themes/endorfin/img/endorfin-s-popisem.png" width="150" height="167" style="display: block; padding-bottom: 20px;" border="0"></a></td>
                      </tr>
                  </table>
                  <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                    <tr>
                      <td>'
                        .  $body;                     
                        if ( !empty( $button_link ) && !empty( $button_text ) ) { 
                        $return .='<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <a href="'.$button_link.'" target="_blank" style="background-color: #ffffff;
                                        border: solid 1px #cdb48f;
                                        border-radius: 5px;
                                        box-sizing: border-box;
                                        color: #cdb48f;
                                        cursor: pointer;
                                        display: inline-block;
                                        font-size: 14px;
                                        font-weight: bold;
                                        margin: 0;
                                        padding: 12px 25px;
                                        text-decoration: none;
                                        text-transform: capitalize;">'. $button_text .'</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>';
                      }
                        
                       $return .='</td>
                    </tr>
                  </table>
                </td>
              </tr>
            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer" style="clear: both;  padding-top: 10px;  text-align: center;  width: 100%; ">
              <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                <tr>
                  <td class="content-block" align="center" style="width: 100%">
                    <p class="apple-link" style="color: #999999; font-size: 12px; line-height: 17px; padding-bottom: 5px;">Petrohradská 216/3, Praha 10 – Vršovice, 101 00</p>
                    <p class="apple-link" style="color: #999999; font-size: 12px; line-height: 17px; padding-bottom: 5px;">Email: <a href="mailto:info@endorfin.cz" style="color: #999999; font-size: 12px; line-height: 17px; padding-bottom: 5px;">info@endorfin.cz</a></p>
                    <p class="apple-link" style="color: #999999; font-size: 12px; line-height: 17px; padding-bottom: 5px;">Telefon: <a href="tel:00420725944311" style="color: #999999; font-size: 12px; line-height: 17px;">+420 725 944 311</a></p>
                  </td>
                </tr>

                <tr>
                    <td align="center" valign="middle"  style="width: 100%">
                        <a href="https://www.facebook.com/endorfincz/" target="_blank" style="display: inline-block;padding-right: 5px;text-decoration: none;"><img src="http://endorfin.cz/img/Facebook.png" alt="Facebook" 
                            style="width: 35px; height: 35px;"></a><a href="https://www.instagram.com/endorfin.cz/" target="_blank" style="display: inline-block; text-decoration: none;"><img src="http://endorfin.cz/img/instagram.png" alt="Instagram" style="width: 35px; height: 35px;"></a>
                    </td>
                </tr>

      
                <tr>
                  <td class="content-block powered-by"  style="width: 100%">
                    <a href="http://endorfin.cz/" target="_blank" style="color: #999999; font-size: 12px; line-height: 17px; padding-bottom: 5px;">Endorfin 2018</a>
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>';

return $return;

  }

}

/* Change email name and email
==========================================================*/
add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
function my_mail_from_name( $name ) {
    return "Jméno";
}

add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email ) {
    return "email";
}
