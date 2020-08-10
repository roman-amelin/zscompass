(function( $ ) {

    //lazyload all images
    function lazyImages( offset ) {

        if(offset === undefined) {
            offset = 250;
        }

        if ( $("[data-lazyimg]").length > 0 ){
            $("[data-lazyimg]").each(function( index ) {
                if ( $(this).in_viewport( offset ) === true ) {
                    var src = $(this).data('lazyimg')
                    var srcset = $(this).data('lazy-srcset');
                    if ( src !== undefined && src !== "" ) {
                        if ( !$(this).hasClass('lazy-loaded') ) {
                            $(this).attr( 'src', src ).addClass("lazy-loaded");
                        }
                    }

                    //if we manipulated the conteiner
                    if ( $(this).data('placeholder') !== "" && $(this).data('placeholder') !== undefined ) {
                        var container = $(this).parent();
                        //avoid jumping on size change
                        setTimeout( function( ){

                            if ( container.css( 'width' ) !== "auto" || container.css( 'height' ) !== "auto" ) {
                                container.css( 'width', "auto" );
                                container.css( 'height', "auto" );
                            }

                        }, 10 );
                    }

                    //add srcset to the lazyloaded images
                    if ( srcset !== "" && srcset !== undefined ) {
                        $(this).attr( 'srcset', srcset );
                        
                    }

                }
            });
        }
            
    }

    //lazyload all background images
    function lazybackgrounds( offset ) {

        if(offset === undefined) {
            offset = 250;
        }

        if ( $("[data-lazybg]").length > 0 ){ 
            $("[data-lazybg]").each(function( index ) {
                if ( $(this).in_viewport( offset ) === true ) {
                    var src = $(this).data('lazybg');
                    if ( src !== undefined && src !== "" ) {
                        if ( !$(this).hasClass('lazy-loaded') ) {
                            $(this).css( 'background-image', "url(" + src + ")" ).addClass("lazy-loaded");
                        }
                    }
                }
            });
        }
    }

    //if the element touches the edge of the screen or is in viewport, it returns true
    $.fn.in_viewport = function( offset ) {

        if(offset === undefined) {
            offset = 250;
        }
        
        var $t            = $(this),
            $w            = $(window),
            viewTop       = $w.scrollTop(),
            viewBottom    = viewTop + $w.height(),
            _top          = $t.offset().top,
            _bottom       = _top + $t.height();
      
        return ((_top <= viewBottom + offset) && (_bottom >= viewTop - offset));

    }; 

    //ready state
    $(document).ready( function() {

        //lazyload all background images
        $("[data-placeholder]").each(function( index ) {
        
            var placeholderSizes = $(this).data('placeholder');
            var container = $(this).parent();
            
            if ( placeholderSizes !== "" /*&& container.css('width') === "auto"*/ ) {

                var width = placeholderSizes.substring(0, placeholderSizes.indexOf(","));
                var height = placeholderSizes.split(',')[1];
                
                if ( width > 0 && height > 0 ) {

                    //container width and calculate height
                    var imgheight = container.width() * height / width;

                    //set the values
                    if ( !container.hasClass('aligncenter') ) {

                        container.css( 'width', container.width( ) );
                        container.css( 'height', container.height( imgheight ) );
                        container.addClass("lazy-placeholder");
                        
                    }                    

                }
            }
            
        });
    });

    //vertical slider
    $(window).on('load scroll resize hashchange', function() {

        //lazyload images
        lazyImages( 250 );

        //lazyload backgrounds
        lazybackgrounds( 250 );
  
    });

})(jQuery);
