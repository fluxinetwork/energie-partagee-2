/*------------------------------*\

    #CONFIG

\*------------------------------*/

var siteURL = '';
var isHome = false;

// Activate resize events
var resizeEvent = false;
var resizeDebouncer = true;

// Store window sizes
var windowH; 
var windowW; 
calc_window();

// Breakpoint
var bpSmall;
var bpMedium;
var bpLarge;
var bpXlarge;




/*------------------------------*\

    #FUNCTIONS

\*------------------------------*/



/*------------------------------*\

    #LOAD

\*------------------------------*/


$(window).load(function() {

});






/*------------------------------*\

    #READY

\*------------------------------*/

var FOO = {
    common: {
        init: function() {
        }
    },
    home: {
        init: function() {
            isHome = true; 
        }
    }
};

var UTIL = {
    fire: function(func, funcname, args) {
        var namespace = FOO;
        funcname = (funcname === undefined) ? 'init' : funcname;
        if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
          namespace[func][funcname](args);
        }
    },
    loadEvents: function() {
        UTIL.fire('common');
        $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
          UTIL.fire(classnm);
        });
    }
};

$(document).ready(UTIL.loadEvents);





/*------------------------------*\

    #RESIZE

    Is activated by vars in config.js

\*------------------------------*/

/**
 * MAIN RESIZE EVENT
 *
 */

function resize_handler() {

}
if ( resizeEvent ) { $( window ).bind( "resize", resize_handler() ); }

/**
 * DEBOUNCER
 * Fire event when stop resizing
 */

function debouncer( func , timeout ) {
    var timeoutID;
    var timeoutVAR;

    if (timeout) {
        timeoutVAR = timeout;
    } else {
        timeoutVAR = 200;
    }

    return function() {
        var scope = this , args = arguments;
        clearTimeout( timeoutID );
        timeoutID = setTimeout( function () {
            func.apply( scope , Array.prototype.slice.call( args ) );
        }, timeoutVAR );
    };

}

function debouncer_handler() {
    calc_window();
}
if ( resizeDebouncer ) { $( window ).bind( "resize", debouncer(debouncer_handler) ); }





/*------------------------------*\

    #TOOLS

\*------------------------------*/

/**
 * Get window sizes
 * Store results in windowW and windowH vars
 */

// Get width and height
function calc_window() {
	calc_windowW();
	calc_windowH();
}
// Get width
function calc_windowW() {
	windowW = $(window).width();
}
// Get height
function calc_windowH() {
	windowH = $(window).height();
}


/**
 * Test window width
 * Use breakpoint vars set in config.js
 */

function test_layout() {
	calc_windowW();
	if ( windowW<=bpSmall ) {
	    return 'is-small';
	} else if ( windowW>bpSmall && windowW<=bpLarge ) {
		return 'is-medium';
	} else if ( windowW>bpLarge && windowW<=bpXlarge ) {
		return 'is-marge';
	} else if ( windowW>bpXlarge ) {
		return 'is-xlarge';
	}
} 


/* Disable a.js-disable-links */

function disable_links() {
	$('.js-disable-link').click(function(e){
		e.preventDefault();
	});
}


/* Remove img title on roll-over, store it in data and then fill it back on roll-out */

function disable_titles() {
	$('.js-disable-title').hover(
		function(){
			var cible = $(this);
			cible.data( 'title', cible.attr('title') ).attr('title','');
		},
		function() {
			var cible = $(this);
			cible.attr( 'title', cible.data('title') );
		}		
	);
}


/**
 * Monitor img loading progress
 * Using Images Loaded : http://imagesloaded.desandro.com
 */

function loading_img(container, loader) {
	container.addClass('is-loading');
	var nbImg = container.find('img').length-1;
	
	container.imagesLoaded().progress(onProgress).always(onAlways);

	function onProgress(imgLoad, image) {
		var percent = Math.round(stepLoad*(100/nbImg));
		//$('.loader__bar').css('width', percent+'%');
	}

	function onAlways() {
		container.removeClass('is-loading');
		//$('.loader').remove();
	}
}

/*										 
\\   FLUXI CONTENT
*/				

// -- Galeries
	if($('.galerie_damier').length){
		$('.galerie_damier').lightGallery({
			thumbnail:false
			, thumbMargin:0
			, thumbContHeight:90
			/*, animateThumb: false
    		, showThumbByDefault: false*/
		}); 
	}
	if($('ul.galerie_vignettes').length){
		$('ul.galerie_vignettes').lightSlider({
			gallery:true,
			item:1,
			loop:false,
			thumbItem:9,
			slideMargin:0,
			enableDrag: false,
			adaptiveHeight:true,
			currentPagerPosition:'middle',			      
			onSliderLoad: function(el) {
				el.lightGallery({
					selector: '.galerie_vignettes .lslide'
				});
			}   
		}); 
	}
	if($('ul.galerie_slider').length){
		$('ul.galerie_slider').lightSlider({
			gallery:false,
			pager:true,
			loop:false,
			item:1,
			adaptiveHeight:true,        	
        	slideMargin:0,
        	loop:true
		}); 
	}
	// -- Accordéons
	if($('.accord').length){
		$('.accord .head-accord').click( function(e) {  			
			$(this).parent().find('.content-accord').slideToggle();		
		});
	}
	if($('.lightbox').length){
		// -- Lightbox Img
		$('.lightbox').lightGallery({
			selector: 'this'
		});
	}
	// Mozaic Isotope
	// regarder :: http://isotope.metafizzy.co/filtering.html
	  if($('.main-isogrid').length){
		  
		  $('.main-isogrid').each(function( i ) {	
			  //var $container = $(this);
			  var $container = $('.main-isogrid');				  
			  /*var random_id = $container.attr('class').split('_');
			  random_id = random_id[1];*/			
			  var $the_iso_grid = $container.isotope({
				itemSelector: '.item',
				layoutMode: 'masonry',			
				transitionDuration: '0.5s',		
				hiddenStyle: {
				  opacity: 0
				},
				visibleStyle: {
				  opacity: 1
				}
			  });
			  
			  $('.sorts').on( 'click', 'button', function() {	
			  	var filterValue = $( this ).attr('data-filter');    
				$the_iso_grid.isotope({ filter: filterValue });
				
			  });				
			
		  });
		  
		  // file type icon
			$(".main-isogrid a[href$='.pdf'] .icon-doc").addClass('js-icon-pdf');
			$(".main-isogrid a[href$='.zip'] .icon-doc, .docs a[href$='.rar'] .icon-doc").addClass('js-icon-zip');
			$(".main-isogrid a[href$='.odt'] .icon-doc").addClass('js-icon-odt');
			$(".main-isogrid a[href$='.doc'] .icon-doc, .docs a[href$='.docx'] .icon-doc").addClass('js-icon-word');  
			$(".main-isogrid a[href$='.xls'] .icon-doc, .docs a[href$='.xlsx'] .icon-doc, .main-isogrid a[href$='.xlt'] .icon-doc, .main-isogrid a[href$='.xltx'] .icon-doc").addClass('js-icon-exel');  
	  }