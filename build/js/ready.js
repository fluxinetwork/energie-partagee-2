/*------------------------------*\

    #READY

\*------------------------------*/

var FOO = {
    common: {
        init: function() {
			// Nav
			for (var i=0; i<nbNavItems; i++) {				
				pp_nav();
			}
			// Menu
			$(document).bind('mousewheel', function(event) {
                var documentOffset = $(window).scrollTop();
                if ( event.deltaY < 0 && !$('.navbar__id').hasClass('is-compact')  ) {
                    $('.navbar, .navbar__id').addClass('is-compact');
                } else if (event.deltaY > 0 && $('.navbar__id').hasClass('is-compact'))  {
                    $('.navbar, .navbar__id').removeClass('is-compact');
                }
            });
			// Mini slider project
			initLoadMoreProjectsBtn();
        }
    },
    home: {
        init: function() {
            isHome = true; 
        }
    },
	page: {
        init: function() {
			$(".fitvids").fitVids();
			initLoadMorePostsBtn();
			if($('body.page-template-page-projets').length){	
				initProjectsMap();
			}
        }
    },
	category: {
        init: function() {			
			
        }
    },
	projets: {
        init: function() {			
			initProjectsMap();
        }
    },
	single: {
        init: function() {
			if($('body.single-projets').length){			
				initSingleMap();
			}
        }
    },	
	contact:{
		init: function() {
			initContactForm();
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




