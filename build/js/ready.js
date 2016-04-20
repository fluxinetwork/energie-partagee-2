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

			// Video lightbox
			$('.lightvideo').lightGallery();

            // Wrap anim
            if ($('.no-touch .wrap-anim').length) {
                $('.wrap-anim').waypoint(function(){
                    $(this.element).toggleClass('ready-anim');
                }, {offset: '85%'});
            }

            // Warning flexbox
            if ($('html').hasClass('detect_no-flexbox')) {
                $('.warning-flexbox').addClass('show-me');
            }

            // Fitvids
            if ($('.fitvids').length) {
                $(".fitvids").fitVids();
            }
        }
    },
    home: {
        init: function() {
            isHome = true; 

            // Anim chiffres clés
            if ($('body').hasClass('touch')) {
                $('.key-nums__item__num').each(function(){
                    $(this).html($(this).attr('data-number'));
                });
            } else {
                $('.key-nums__item__num').each(function(){
                    var num = $(this);
                    var txt = $(this).next();
                    var val = $(this).attr('data-number');
                    var speed = (val>1000) ? 3000 : val*100;
                    $(this).jQuerySimpleCounter({
                      start:  0,
                      end:  val,
                      duration: speed,
                      complete: function(){
                        num.html(val);
                      }
                    });
                });
            }

            // Mini slider project
            initLoadMoreProjectsBtn();
        }
    },
    single: {
        init: function() {
            $(".fitvids").fitVids();
        }
    },  
    single_projets: {
        init: function() {          
            initSingleMap();                
            initSendMailPorspect();

            // Serparate big numbers
            if($('.repartition').length){                    
                $('.repartition .infosbloc li .data-capital').each(function( i ) {
                    $(this).html(formatNumber($(this).data('capital')) + ' €');                        
                });
            }

            // Activate map
            $('.touch .map-holder').on('click', function(){
                $(this).addClass('is-active');
            });

            // Floater
            $('.following .box__btn').clone().appendTo(".following--clone .wrap").on('click', function(){
                $('body').animate({scrollTop: $('.description').offset().top-50}, 250);
                $('.following .cta').click();
            });
            $('.following').waypoint(function(direction){
                if (direction=='down') {
                    $(".following--clone").removeClass('slide-down').addClass('slide-up');
                } else {
                    $(".following--clone").removeClass('slide-up').addClass('slide-down'); 
                }
            });
            $('.footer').waypoint(function(){
               $(".following--clone").toggleClass('slide-down');
            }, {offset: '100%'});
        }
    },
	page: {
        init: function() {
			initLoadMorePostsBtn();

            // wrap suggestion
            if ($('.suggestion').length) {
                $('.fluxi-wrap').addClass('has-suggestion');
            }		
        }
    },
    page_template_page_projets: {
        init: function() {
            initProjectsMap();
            initLoadMoreProjectsCardsBtn(); 
        }
    },
	category: {
        init: function() {			
			initLoadMorePostsBtn();
        }
    },
	contact:{
		init: function() {
			initContactForm();

            // Add mailto in clikarde
            $('.clikarde__item').each(function( i ) {
                var dataMailto,
                    dataHref = $(this).find('.minicard').attr('href');

                if(dataHref.indexOf('@') > -1){
                    dataMailto = dataHref.substring(7);

                    $(this).find('.minicard').attr('href', 'mailto:'+dataMailto);
                }
            });
        }
	},
    search:{
        init: function() {
            $('.nav__search__input').focus();
			// Test to select active filter option in search filters
			if((window.location.href).split("&")[1] != void 0){
				var activeFilter = (window.location.href).split("&")[1];
				var filterVal = activeFilter.substring(4);				
				$('#search-filters #filter option[value='+filterVal+']').attr('selected','selected');
			}
			
			$('#search-filters').change(function() {
				var filterType;
                var filterVal = $('#search-filters #filter option:selected').val();
			  	
				if($.isNumeric(filterVal)){
					filterType = 'cat';
				}else{
					filterType = 'cpt';
				}
				var urlSeach = (window.location.href).split('&')[0] ;
               location.href = urlSeach+'&'+filterType+'='+filterVal;
            });
			
            calc_windowH();
            if (windowH<$('.footer').offset().top) {
                $('#search-filters').waypoint(function(){
                    $(this.element).toggleClass('is-fixed');
                });
                $('.footer').waypoint(function(){
                    $('#search-filters').toggleClass('is-fixed');
                }, {offset: '100%'});
            }
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




