
(function( $ ) {

        //init on load
    jQuery(window).on( "load", function() {
        
        //fire up foundation
        jQuery(document).foundation();
        
    });

    //resize equalizer resize
    jQuery(window).on( "resize", function() {
        
        //fire up foundation
        Foundation.reInit('equalizer');
        
    });

    function get_lang(){
        if ( $("body").hasClass( 'english' ) ) {
            return "eng";
        } else {
            return "cze";
        }
    }

    //show or hide the top menu
    $(window).on( "scroll load", function() {

        if ($(window).scrollTop() >= 50 ) {
            
            if ( !$('body').hasClass('scrolled')){

                $('body').addClass('scrolled');
                $('#main-menu-container').hide().fadeIn(); 

            }
                                                  
        //reverse it back    
        } else if ($(window).scrollTop() < 50){
            
            if ($('body').hasClass('scrolled')){

                $('body').removeClass('scrolled');

            }

        }
            
    });

    /* Slide out menu
    ====================================================================*/

    //include slideout menu
    !function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;"undefined"!=typeof window?e=window:"undefined"!=typeof global?e=global:"undefined"!=typeof self&&(e=self),e.Slideout=t()}}(function(){var t,e,n;return function i(t,e,n){function o(r,a){if(!e[r]){if(!t[r]){var u=typeof require=="function"&&require;if(!a&&u)return u(r,!0);if(s)return s(r,!0);var l=new Error("Cannot find module '"+r+"'");throw l.code="MODULE_NOT_FOUND",l}var f=e[r]={exports:{}};t[r][0].call(f.exports,function(e){var n=t[r][1][e];return o(n?n:e)},f,f.exports,i,t,e,n)}return e[r].exports}var s=typeof require=="function"&&require;for(var r=0;r<n.length;r++)o(n[r]);return o}({1:[function(t,e,n){"use strict";var i=t("decouple");var o=t("emitter");var s;var r=false;var a=window.document;var u=a.documentElement;var l=window.navigator.msPointerEnabled;var f={start:l?"MSPointerDown":"touchstart",move:l?"MSPointerMove":"touchmove",end:l?"MSPointerUp":"touchend"};var h=function v(){var t=/^(Webkit|Khtml|Moz|ms|O)(?=[A-Z])/;var e=a.getElementsByTagName("script")[0].style;for(var n in e){if(t.test(n)){return"-"+n.match(t)[0].toLowerCase()+"-"}}if("WebkitOpacity"in e){return"-webkit-"}if("KhtmlOpacity"in e){return"-khtml-"}return""}();function c(t,e){for(var n in e){if(e[n]){t[n]=e[n]}}return t}function p(t,e){t.prototype=c(t.prototype||{},e.prototype)}function d(t){while(t.parentNode){if(t.getAttribute("data-slideout-ignore")!==null){return t}t=t.parentNode}return null}function _(t){t=t||{};this._startOffsetX=0;this._currentOffsetX=0;this._opening=false;this._moved=false;this._opened=false;this._preventOpen=false;this._touch=t.touch===undefined?true:t.touch&&true;this._side=t.side||"left";this.panel=t.panel;this.menu=t.menu;if(!this.panel.classList.contains("slideout-panel")){this.panel.classList.add("slideout-panel")}if(!this.panel.classList.contains("slideout-panel-"+this._side)){this.panel.classList.add("slideout-panel-"+this._side)}if(!this.menu.classList.contains("slideout-menu")){this.menu.classList.add("slideout-menu")}if(!this.menu.classList.contains("slideout-menu-"+this._side)){this.menu.classList.add("slideout-menu-"+this._side)}this._fx=t.fx||"ease";this._duration=parseInt(t.duration,10)||300;this._tolerance=parseInt(t.tolerance,10)||70;this._padding=this._translateTo=parseInt(t.padding,10)||256;this._orientation=this._side==="right"?-1:1;this._translateTo*=this._orientation;if(this._touch){this._initTouchEvents()}}p(_,o);_.prototype.open=function(){var t=this;this.emit("beforeopen");if(!u.classList.contains("slideout-open")){u.classList.add("slideout-open")}this._setTransition();this._translateXTo(this._translateTo);this._opened=true;setTimeout(function(){t.panel.style.transition=t.panel.style["-webkit-transition"]="";t.emit("open")},this._duration+50);return this};_.prototype.close=function(){var t=this;if(!this.isOpen()&&!this._opening){return this}this.emit("beforeclose");this._setTransition();this._translateXTo(0);this._opened=false;setTimeout(function(){u.classList.remove("slideout-open");t.panel.style.transition=t.panel.style["-webkit-transition"]=t.panel.style[h+"transform"]=t.panel.style.transform="";t.emit("close")},this._duration+50);return this};_.prototype.toggle=function(){return this.isOpen()?this.close():this.open()};_.prototype.isOpen=function(){return this._opened};_.prototype._translateXTo=function(t){this._currentOffsetX=t;this.panel.style[h+"transform"]=this.panel.style.transform="translateX("+t+"px)";return this};_.prototype._setTransition=function(){this.panel.style[h+"transition"]=this.panel.style.transition=h+"transform "+this._duration+"ms "+this._fx;return this};_.prototype._initTouchEvents=function(){var t=this;this._onScrollFn=i(a,"scroll",function(){if(!t._moved){clearTimeout(s);r=true;s=setTimeout(function(){r=false},250)}});this._preventMove=function(e){if(t._moved){e.preventDefault()}};a.addEventListener(f.move,this._preventMove);this._resetTouchFn=function(e){if(typeof e.touches==="undefined"){return}t._moved=false;t._opening=false;t._startOffsetX=e.touches[0].pageX;t._preventOpen=!t._touch||!t.isOpen()&&t.menu.clientWidth!==0};this.panel.addEventListener(f.start,this._resetTouchFn);this._onTouchCancelFn=function(){t._moved=false;t._opening=false};this.panel.addEventListener("touchcancel",this._onTouchCancelFn);this._onTouchEndFn=function(){if(t._moved){t.emit("translateend");t._opening&&Math.abs(t._currentOffsetX)>t._tolerance?t.open():t.close()}t._moved=false};this.panel.addEventListener(f.end,this._onTouchEndFn);this._onTouchMoveFn=function(e){if(r||t._preventOpen||typeof e.touches==="undefined"||d(e.target)){return}var n=e.touches[0].clientX-t._startOffsetX;var i=t._currentOffsetX=n;if(Math.abs(i)>t._padding){return}if(Math.abs(n)>20){t._opening=true;var o=n*t._orientation;if(t._opened&&o>0||!t._opened&&o<0){return}if(!t._moved){t.emit("translatestart")}if(o<=0){i=n+t._padding*t._orientation;t._opening=false}if(!(t._moved&&u.classList.contains("slideout-open"))){u.classList.add("slideout-open")}t.panel.style[h+"transform"]=t.panel.style.transform="translateX("+i+"px)";t.emit("translate",i);t._moved=true}};this.panel.addEventListener(f.move,this._onTouchMoveFn);return this};_.prototype.enableTouch=function(){this._touch=true;return this};_.prototype.disableTouch=function(){this._touch=false;return this};_.prototype.destroy=function(){this.close();a.removeEventListener(f.move,this._preventMove);this.panel.removeEventListener(f.start,this._resetTouchFn);this.panel.removeEventListener("touchcancel",this._onTouchCancelFn);this.panel.removeEventListener(f.end,this._onTouchEndFn);this.panel.removeEventListener(f.move,this._onTouchMoveFn);a.removeEventListener("scroll",this._onScrollFn);this.open=this.close=function(){};return this};e.exports=_},{decouple:2,emitter:3}],2:[function(t,e,n){"use strict";var i=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||function(t){window.setTimeout(t,1e3/60)}}();function o(t,e,n){var o,s=false;function r(t){o=t;a()}function a(){if(!s){i(u);s=true}}function u(){n.call(t,o);s=false}t.addEventListener(e,r,false);return r}e.exports=o},{}],3:[function(t,e,n){"use strict";var i=function(t,e){if(!(t instanceof e)){throw new TypeError("Cannot call a class as a function")}};n.__esModule=true;var o=function(){function t(){i(this,t)}t.prototype.on=function e(t,n){this._eventCollection=this._eventCollection||{};this._eventCollection[t]=this._eventCollection[t]||[];this._eventCollection[t].push(n);return this};t.prototype.once=function n(t,e){var n=this;function i(){n.off(t,i);e.apply(this,arguments)}i.listener=e;this.on(t,i);return this};t.prototype.off=function o(t,e){var n=undefined;if(!this._eventCollection||!(n=this._eventCollection[t])){return this}n.forEach(function(t,i){if(t===e||t.listener===e){n.splice(i,1)}});if(n.length===0){delete this._eventCollection[t]}return this};t.prototype.emit=function s(t){var e=this;for(var n=arguments.length,i=Array(n>1?n-1:0),o=1;o<n;o++){i[o-1]=arguments[o]}var s=undefined;if(!this._eventCollection||!(s=this._eventCollection[t])){return this}s=s.slice(0);s.forEach(function(t){return t.apply(e,i)});return this};return t}();n["default"]=o;e.exports=n["default"]},{}]},{},[1])(1)});

    var slideout = new Slideout({
        'panel': document.getElementById('panel'),
        'menu': document.getElementById('menu'),
        'padding': 256,
        'side': 'right',
        'tolerance': 70
    });

    // Toggle button
    document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
        slideout.toggle();
    });
    
    //toggle button 2
    document.querySelector('.slideout-menu .close-button').addEventListener('click', function() {
        slideout.toggle();
    });

    //sidebar menu functionality
    jQuery(document).ready( function(){         
        
        $( "#mobile-menu li" ).each(function( index, element ){

            var classes = $(this).attr('class');

            //add arrows to elements with children  
            if (  classes.indexOf("menu-item-has-children") >= 0 ) {

                $(this).prepend('<i class="arrow"> </i>');
            }  

        });

        //click functionality
        $("#mobile-menu .arrow").click(function(){
              
            if ( $("#mobile-menu > .menu-item-has-children").hasClass("showing-ul") ) {
                //exclude this element
                var myParent = $(this).closest("#mobile-menu > .menu-item-has-children");
                $("#mobile-menu > .menu-item-has-children").not(myParent).removeClass("showing-ul").children(".sub-menu").slideUp();
            }

            //show signling
            if ( $(this).parent().hasClass("showing-ul") )  {
                $(this).siblings(".sub-menu").slideUp();
                $(this).parent().removeClass("showing-ul");
            } else {
                //
                $(this).siblings(".sub-menu").slideDown();
                $(this).parent().addClass("showing-ul");
            }       

        });

     }); 


    /* slidein functionality
    ========================================================*/

     /**
       * Copyright 2012, Digital Fusion
       * Licensed under the MIT license.
       * http://teamdf.com/jquery-plugins/license/
       *
       * @author Sam Sehnert
       * @desc A small plugin that checks whether elements are within
       *     the user visible viewport of a web browser.
       *     only accounts for vertical position, not horizontal.
       */

      $.fn.visible = function(partial) {
        
          var $t            = $(this),
              $w            = $(window),
              viewTop       = $w.scrollTop(),
              viewBottom    = viewTop + $w.height(),
              _top          = $t.offset().top,
              _bottom       = _top + $t.height(),
              compareTop    = partial === true ? _bottom : _top,
              compareBottom = partial === true ? _top : _bottom;
        
        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

      }; 

        var win = $(window);
        var allMods = $(".slide-up");
        var allFades = $(".bounce-in");

        // Already visible modules
        allMods.each(function(i, el) {
            var el = $(el);
            
            if ( $("#fullpage").length === 0 ) { 
                
                if (el.visible(true)) {
                   el.addClass("visible"); 
                } 

            }
        });

        win.on( 'scroll load', function(event) {
            //slide up
            allMods.each(function(i, el) {
                var el = $(el);
                if (el.visible(true)) {
                  el.addClass("come-in"); 
                } 
            });

            //fade in animations
             allFades.each(function(i, el) {
                var el = $(el);
                if (el.visible(true)) {
                    el.addClass("come-in"); 
                } 
            });
          
        });


        /**
     *  
     * JQUERY EU COOKIE LAW POPUPS
     * version 1.0.1
     * 
     * Code on Github:
     * https://github.com/wimagguc/jquery-eu-cookie-law-popup
     * 
     * To see a live demo, go to:
     * http://www.wimagguc.com/2015/03/jquery-eu-cookie-law-popup/
     * 
     * by Richard Dancsi
     * http://www.wimagguc.com/
     * 
     */

    // for ie9 doesn't support debug console >>>
    if (!window.console) window.console = {};
    if (!window.console.log) window.console.log = function () { };
    // ^^^

    $.fn.euCookieLawPopup = (function() {

        var _self = this;

        var button_text, button_more, etn_link;
        if ( get_lang() == "eng" ) {
            button_text = 'Continue';
            button_more = 'Learn&nbsp;more';
            etn_link = '/en/business-terms/';
        } else {
            button_text = 'Přijímám';
            button_more = 'Více&nbsp;informací';
            etn_link = '/obchodni-podminky/';
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////
        // PARAMETERS (MODIFY THIS PART) //////////////////////////////////////////////////////////////
        _self.params = {
            cookiePolicyUrl : etn_link,
            popupPosition : 'top',
            colorStyle : 'default',
            compactStyle : false,
            popupTitle : 'This website is using cookies',
            popupText : 'We use cookies to ensure that we give you the best experience on our website. If you continue without changing your settings, we\'ll assume that you are happy to receive all cookies on this website.',
            buttonContinueTitle : button_text,
            buttonLearnmoreTitle : button_more,
            buttonLearnmoreOpenInNewWindow : true,
            agreementExpiresInDays : 30,
            autoAcceptCookiePolicy : false,
            htmlMarkup : null
        };

        ///////////////////////////////////////////////////////////////////////////////////////////////
        // VARIABLES USED BY THE FUNCTION (DON'T MODIFY THIS PART) ////////////////////////////////////
        _self.vars = {
            INITIALISED : false,
            HTML_MARKUP : null,
            COOKIE_NAME : 'EU_COOKIE_LAW_CONSENT'
        };

        ///////////////////////////////////////////////////////////////////////////////////////////////
        // PRIVATE FUNCTIONS FOR MANIPULATING DATA ////////////////////////////////////////////////////

        // Overwrite default parameters if any of those is present
        var parseParameters = function(object, markup, settings) {

            if (object) {
                var className = $(object).attr('class') ? $(object).attr('class') : '';
                if (className.indexOf('eupopup-top') > -1) {
                    _self.params.popupPosition = 'top';
                }
                else if (className.indexOf('eupopup-fixedtop') > -1) {
                    _self.params.popupPosition = 'fixedtop';
                }
                else if (className.indexOf('eupopup-bottomright') > -1) {
                    _self.params.popupPosition = 'bottomright';
                }
                else if (className.indexOf('eupopup-bottomleft') > -1) {
                    _self.params.popupPosition = 'bottomleft';
                }
                else if (className.indexOf('eupopup-bottom') > -1) {
                    _self.params.popupPosition = 'bottom';
                }
                else if (className.indexOf('eupopup-block') > -1) {
                    _self.params.popupPosition = 'block';
                }
                if (className.indexOf('eupopup-color-default') > -1) {
                    _self.params.colorStyle = 'default';
                }
                else if (className.indexOf('eupopup-color-inverse') > -1) {
                    _self.params.colorStyle = 'inverse';
                }
                if (className.indexOf('eupopup-style-compact') > -1) {
                    _self.params.compactStyle = true;
                }
            }

            if (markup) {
                _self.params.htmlMarkup = markup;
            }

            if (settings) {
                if (typeof settings.cookiePolicyUrl !== 'undefined') {
                    _self.params.cookiePolicyUrl = settings.cookiePolicyUrl;
                }
                if (typeof settings.popupPosition !== 'undefined') {
                    _self.params.popupPosition = settings.popupPosition;
                }
                if (typeof settings.colorStyle !== 'undefined') {
                    _self.params.colorStyle = settings.colorStyle;
                }
                if (typeof settings.popupTitle !== 'undefined') {
                    _self.params.popupTitle = settings.popupTitle;
                }
                if (typeof settings.popupText !== 'undefined') {
                    _self.params.popupText = settings.popupText;
                }
                if (typeof settings.buttonContinueTitle !== 'undefined') {
                    _self.params.buttonContinueTitle = settings.buttonContinueTitle;
                }
                if (typeof settings.buttonLearnmoreTitle !== 'undefined') {
                    _self.params.buttonLearnmoreTitle = settings.buttonLearnmoreTitle;
                }
                if (typeof settings.buttonLearnmoreOpenInNewWindow !== 'undefined') {
                    _self.params.buttonLearnmoreOpenInNewWindow = settings.buttonLearnmoreOpenInNewWindow;
                }
                if (typeof settings.agreementExpiresInDays !== 'undefined') {
                    _self.params.agreementExpiresInDays = settings.agreementExpiresInDays;
                }
                if (typeof settings.autoAcceptCookiePolicy !== 'undefined') {
                    _self.params.autoAcceptCookiePolicy = settings.autoAcceptCookiePolicy;
                }
                if (typeof settings.htmlMarkup !== 'undefined') {
                    _self.params.htmlMarkup = settings.htmlMarkup;
                }
            }

        };

        var createHtmlMarkup = function() {

            if (_self.params.htmlMarkup) {
                return _self.params.htmlMarkup;
            }

            var html = 
                '<div class="eupopup-container' + 
                    ' eupopup-container-' + _self.params.popupPosition + 
                    (_self.params.compactStyle ? ' eupopup-style-compact' : '') + 
                    ' eupopup-color-' + _self.params.colorStyle + '">' +
                    '<div class="eupopup-head">' + _self.params.popupTitle + '</div>' +
                    '<div class="eupopup-body">' + _self.params.popupText + '</div>' +
                    '<div class="eupopup-buttons">' +
                      '<a href="#" class="eupopup-button eupopup-button_1">' + _self.params.buttonContinueTitle + '</a>' +
                      '<a href="' + _self.params.cookiePolicyUrl + '"' +
                        (_self.params.buttonLearnmoreOpenInNewWindow ? ' target=_blank ' : '') +
                        ' class="eupopup-button eupopup-button_2">' + _self.params.buttonLearnmoreTitle + '</a>' +
                      '<div class="clearfix"></div>' +
                    '</div>' +
                    '<a href="#" class="eupopup-closebutton">x</a>' +
                '</div>';

            return html;
        };

        // Storing the consent in a cookie
        var setUserAcceptsCookies = function(consent) {
            var d = new Date();
            var expiresInDays = _self.params.agreementExpiresInDays * 24 * 60 * 60 * 1000;
            d.setTime( d.getTime() + expiresInDays );
            var expires = "expires=" + d.toGMTString();
            document.cookie = _self.vars.COOKIE_NAME + '=' + consent + "; " + expires + ";path=/";

            $(document).trigger("user_cookie_consent_changed", {'consent' : consent});
        };

        // Let's see if we have a consent cookie already
        var userAlreadyAcceptedCookies = function() {
            var userAcceptedCookies = false;
            var cookies = document.cookie.split(";");
            for (var i = 0; i < cookies.length; i++) {
                var c = cookies[i].trim();
                if (c.indexOf(_self.vars.COOKIE_NAME) == 0) {
                    userAcceptedCookies = c.substring(_self.vars.COOKIE_NAME.length + 1, c.length);
                }
            }

            return userAcceptedCookies;
        };
        
        var hideContainer = function() {
            // $('.eupopup-container').slideUp(200);
            $('.eupopup-container').animate({
                opacity: 0,
                height: 0
            }, 200, function() {
                $('.eupopup-container').hide(0);
            });
        };

        ///////////////////////////////////////////////////////////////////////////////////////////////
        // PUBLIC FUNCTIONS  //////////////////////////////////////////////////////////////////////////
        var publicfunc = {

            // INITIALIZE EU COOKIE LAW POPUP /////////////////////////////////////////////////////////
            init : function(settings) {

                parseParameters(
                    $(".eupopup").first(),
                    $(".eupopup-markup").html(),
                    settings);

                // No need to display this if user already accepted the policy
                if (userAlreadyAcceptedCookies()) {
                    return;
                }

                // We should initialise only once
                if (_self.vars.INITIALISED) {
                    return;
                }
                _self.vars.INITIALISED = true;

                // Markup and event listeners >>>
                _self.vars.HTML_MARKUP = createHtmlMarkup();

                if ($('.eupopup-block').length > 0) {
                    $('.eupopup-block').append(_self.vars.HTML_MARKUP);
                } else {
                    $('BODY').append(_self.vars.HTML_MARKUP);
                }

                $('.eupopup-button_1').click(function() {
                    setUserAcceptsCookies(true);
                    hideContainer();
                    return false;
                });
                $('.eupopup-closebutton').click(function() {
                    setUserAcceptsCookies(true);
                    hideContainer();
                    return false;
                });
                // ^^^ Markup and event listeners

                // Ready to start!
                $('.eupopup-container').show();

                // In case it's alright to just display the message once 
                if (_self.params.autoAcceptCookiePolicy) {
                    setUserAcceptsCookies(true);
                }

            }

        };

        return publicfunc;
    });

    $(document).ready( function() {

        var title, desc;
        if ( get_lang()== "eng" ) { 
            title = 'This website is using cookies.';
            desc = 'We use them to give you the best experience. If you continue using our website, we\'ll assume that you are happy to receive all cookies on this website.';
        } else {
            title = "Naše webová stránka používá cookies";
            desc = "Používáme je, abychom mohli našim zákazníkům poskytnout lepší služby. Odsouhlasením této informace jejich použití schválíte.";
        }


        if ($(".eupopup").length > 0) {
            $(document).euCookieLawPopup().init({
                /*'info' : 'YOU_CAN_ADD_MORE_SETTINGS_HERE',*/
                'popupTitle' :  title,
                'popupText' : desc
            });
        }
    });

    $(document).bind("user_cookie_consent_changed", function(event, object) {
        console.log("User cookie consent changed: " + $(object).attr('consent') );
    });

    //scroll to contact form
    $("#scroll-down").click(function() {
        if ( $("#contact-us").length > 0 ) {
            $('html, body').animate({
                scrollTop: $("#contact-us").offset().top
            }, 1500);
        }
    });




    function get_browser() {

        var ua=navigator.userAgent,tem,M=ua.match(/(opera|yabrowser|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 

        if(/trident/i.test(M[1])){

            tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 

            return {name:'IE',version:(tem[1]||'')};

            }   

        if(M[1]==='Chrome'){

            tem=ua.match(/\bOPR|Edge\/(\d+)/)

            if(tem!=null)   {return {name:'Opera', version:tem[1]};}

            }   

        M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];

        if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}

        return {

        name: M[0],

        version: M[1]

        };

    }

    function iOSversion() {

        if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream) {

            if (!!window.indexedDB) { return 8; }

            if (!!window.SpeechSynthesisUtterance) { return 7; }

            if (!!window.webkitAudioContext) { return 6; }

            if (!!window.matchMedia) { return 5; }

            if (!!window.history && 'pushState' in window.history) { return 4; }

            return 3;

        }



        return '';

    }

    //add css script with js

    function append_no_flexbox(){

        document.querySelector('head').innerHTML += '<link rel="stylesheet" href="https://www.flera.cz/wp-content/themes/flera/assets/styles/css-specific/noflexbox.css" type="text/css"/>';

    }

    $(document).ready( function(){

        //alert( get_browser().name + " " + get_browser().version );

        //select chrome under version 28
        if ( get_browser().name == "Chrome" && parseInt(get_browser().version) <= 28 ) {

            jQuery("html").addClass("no-sliding").addClass("old-chrome").addClass("no-flexbox");

            //append no flexbox css
            append_no_flexbox();

        }

    
        // Select Firefox under 28
        if ( get_browser().name == "Firefox" && parseInt(get_browser().version) <= 28 ) {

            jQuery("html").addClass("no-sliding").addClass("old-firefox").addClass("no-flexbox");

            //append no flexbox css
            append_no_flexbox();


        }



        // Select Safari under version 8

        if ( get_browser().name == "Safari" && parseInt(get_browser().version) <= 8 ) {

            jQuery("html").addClass("no-sliding").addClass("old-safari").addClass("no-flexbox");


            //append no flexbox css

            append_no_flexbox();

        
        }

        // Select IE under 10
        if ( get_browser().name == "Msie" && parseInt(get_browser().version) <= 10 ) {

            jQuery("html").addClass("no-sliding").addClass("old-ie").addClass("no-flexbox");

            //append no flexbox css
            append_no_flexbox();
           

        }

        

        //detect old IOS

        if ( iOSversion() === 4 ||  iOSversion() === 3 ) {

            jQuery("html").addClass("no-sliding").addClass("old-iphone").addClass("no-flexbox");

            //append no flexbox css

            append_no_flexbox();

        }



    });



    //double click on top menu functionality

	/**

     * jquery-doubleTapToGo plugin

     * Copyright 2017 DACHCOM.DIGITAL AG

     * @author Marco Rieser

     * @author Volker Andres

     * @author Stefan Hagspiel

     * @version 3.0.2

     * @see https://github.com/dachcom-digital/jquery-doubletaptogo

     */

    (function ($, window, document, undefined) {

        'use strict';

        var pluginName = 'doubleTapToGo',

            defaults = {

                automatic: true,

                selectorClass: 'doubletap',

                selectorChain: 'li:has(ul)'

            };



        function DoubleTapToGo (element, options) {

            this.element = element;

            this.settings = $.extend({}, defaults, options);

            this._defaults = defaults;

            this._name = pluginName;

            this.init();

        }



        $.extend(DoubleTapToGo.prototype, {

            preventClick: false,

            currentTap: $(),

            init: function () {

                $(this.element)

                    .on('touchstart', '.' + this.settings.selectorClass, this._tap.bind(this))

                    .on('click', '.' + this.settings.selectorClass, this._click.bind(this))

                    .on('remove', this._destroy.bind(this));



                this._addSelectors();

            },



            _addSelectors: function () {

                if (this.settings.automatic !== true) {

                    return;

                }

                $(this.element)

                    .find(this.settings.selectorChain)

                    .addClass(this.settings.selectorClass);

            },



            _click: function (event) {

                if (this.preventClick) {

                    event.preventDefault();

                } else {

                    this.currentTap = $();

                }

            },



            _tap: function (event) {

                var $target = $(event.target).closest('li');

                if (!$target.hasClass(this.settings.selectorClass)) {

                    this.preventClick = false;

                    return;

                }

                if ($target.get(0) === this.currentTap.get(0)) {

                    this.preventClick = false;

                    return;

                }

                this.preventClick = true;

                this.currentTap = $target;

                event.stopPropagation();

            },



            _destroy: function () {

                $(this.element).off();

            },



            reset: function () {

                this.currentTap = $();

            }

        });



        $.fn[pluginName] = function (options) {

            var args = arguments,

                returns;

            if (options === undefined || typeof options === 'object') {

                return this.each(function () {

                    if (!$.data(this, pluginName)) {

                        $.data(this, pluginName, new DoubleTapToGo(this, options));

                    }

                });

            } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {

                this.each(function () {

                    var instance = $.data(this, pluginName),

                        methodName = (options === 'destroy' ? '_destroy' : options);

                    if (instance instanceof DoubleTapToGo && typeof instance[methodName] === 'function') {

                        returns = instance[methodName].apply(instance, Array.prototype.slice.call(args, 1));

                    }

                    if (options === 'destroy') {

                        $.data(this, pluginName, null);

                    }

                });

                return returns !== undefined ? returns : this;

            }

        };

    })(jQuery, window, document);
   

})(jQuery);