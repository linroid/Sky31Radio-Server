$(document).ready(function(){
	var $siderbar = $('#siderbar'),
		$body = $('body');

     // Function that controls opening of the siderbar
    function _start( direction, speed ) {
        var slideWidth = $pageslide.outerWidth( true ),
            bodyAnimateIn = {},
            slideAnimateIn = {};
        // Animate the slide, and attach this slide's settings to the element
        $body.animate(bodyAnimateIn, speed);
        $pageslide.show()
                  .animate(slideAnimateIn, speed, function() {
                      _sliding = false;
                  });
    }
    $.fn.siderbar = function(options) {
        var $elements = this;
        // On click
        $elements.click( function(e) {
            var $self = $(this),
                settings = $.extend({ href: $self.attr('href') }, options);
            // Prevent the default behavior and stop propagation
            e.preventDefault();
            e.stopPropagation();
            if ( $siderbar.is(':visible') && $self[0] == _lastCaller ) {
                // If we clicked the same element twice, toggle closed
                $.siderbar.close();
            } else {
                // Open
                $.siderbar( settings );
                // Record the last element to trigger pageslide
                _lastCaller = $self[0];
            }
        });
	};

	$.fn.pageslide.defaults = {
        speed:      200,        // Accepts standard jQuery effects speeds (i.e. fast, normal or milliseconds)
        direction:  'right',    // Accepts 'left' or 'right'
        modal:      false,      // If set to true, you must explicitly close pageslide using $.pageslide.close();
        iframe:     true,       // By default, linked pages are loaded into an iframe. Set this to false if you don't want an iframe.
        href:       null        // Override the source of the content. Optional in most cases, but required when opening pageslide programmatically.
    };

    // Open the pageslide
	$.siderbar = function( options ) {
// Extend the settings with those the user has provided
        var settings = $.extend({}, $.fn.siderbar.defaults, options);
// Are we trying to open in different direction?
        if( $siderbar.is(':visible') && $siderbar.data( 'direction' ) != settings.direction) {
            $.siderbar.close(function(){
                _load( settings.href, settings.iframe );
                _start( settings.direction, settings.speed );
            });
        } else {
            _load( settings.href, settings.iframe );
            if( $siderbar.is(':hidden') ) {
                _start( settings.direction, settings.speed );
            }
        }
        $siderbar.data( settings );
	}


	//点击外部关闭菜单
    $body.click(function(){
        $.siderbar.close();
    });
	// Close the pageslide
	$.siderbar.close = function( callback ) {
        var $siderbar = $('#siderbar'),
            slideWidth = $siderbar.outerWidth( true ),
            speed = $siderbar.data( 'speed' ),
            bodyAnimateIn = {},
            slideAnimateIn = {}
        // If the slide isn't open, just ignore the call
        if( $siderbar.is(':hidden') || _sliding ) return;
        _sliding = true;
        switch( $siderbar.data( 'direction' ) ) {
            case 'left':
                bodyAnimateIn['padding-left'] = '-=' + slideWidth;
                slideAnimateIn['right'] = '-=' + slideWidth;
                break;
            default:
                bodyAnimateIn['padding-left'] = '+=' + slideWidth;
                slideAnimateIn['left'] = '-=' + slideWidth;
                break;
        }
        $siderbar.animate(slideAnimateIn, speed);
        $body.animate(bodyAnimateIn, speed, function() {
            $siderbar.hide();
            _sliding = false;
            if( typeof callback != 'undefined' ) callback();
        });
    }

    // Don't let clicks to the pageslide close the window
    $siderbar.click(function(e) {
        e.stopPropagation();
    });

    $(document).bind('click keyup', function(e) {
// If this is a keyup event, let's see if it's an ESC key
        if( e.type == "keyup" && e.keyCode != 27) return;
// Make sure it's visible, and we're not modal
	    if( $siderbar.is( ':visible' ) && !$siderbar.data( 'modal' ) ) {
	        $.siderbar.close();
	    }
	});






});