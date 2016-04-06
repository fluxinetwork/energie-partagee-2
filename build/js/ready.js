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
            setTimeout(function(){
                $('.nav').removeClass('is-hidden');
            },1);

			// Mini slider project
			initLoadMoreProjectsBtn();

			// Video lightbox
			$('.lightvideo').lightGallery();

            // Anim section title 
            /*$('section:not(.footer):not(.top-credibility) .s-title').addClass('is-hidden').waypoint(function(){
                $(this.element).toggleClass('is-hidden');
            }, {offset: '90%'});*/

            $('#courtcircuit_contact, #newsletter_footer').waypoint(function(){
                $(this.element).focus();
            }, {offset: '50%'});
        }
    },
    home: {
        init: function() {
            isHome = true; 
            $('.key-nums__item__num').each(function(){
                var txt = $(this).next();
                var val = $(this).attr('data-number');
                var speed = (val>1000) ? 3000 : val*100;
                $(this).jQuerySimpleCounter({
                  start:  0,
                  end:  val,
                  duration: speed
                });
            });

            $('.top-credibility').waypoint(function(){
                $(this.element).find('.wrap-n').toggleClass('ready-anim');
            }, {offset: '90%'});
        }
    },
	page: {
        init: function() {
			$(".fitvids").fitVids();
			initLoadMorePostsBtn();
			if($('body.page-template-page-projets').length){	
				initProjectsMap();
                initLoadMoreProjectsCardsBtn();				
			}			
        }
    },
	category: {
        init: function() {			
			initLoadMorePostsBtn();
        }
    },
	single: {
        init: function() {
			$(".fitvids").fitVids();
			if($('body.single-projets').length){			
				initSingleMap();				
				initSendMailPorspect();			
			}
        }
    },	
	contact:{
		init: function() {
			initContactForm();
        }
	},
    search:{
        init: function() {
            $('.nav__search__input').focus();
            $('#search-filters').change(function() {
                var cat = $("#search-filters option:selected").val();
                var urlSeach = (window.location.href).split("&")[0] ;
                location.href = urlSeach+'&cat='+cat;
            });
            $('#search-filters').waypoint(function(){
                $(this.element).toggleClass('is-fixed');
            });
            $('.footer').waypoint(function(){
                $('#search-filters').toggleClass('is-fixed');
            }, {offset: '100%'});
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




