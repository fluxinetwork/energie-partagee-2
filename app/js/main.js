/*------------------------------*\

    #CONFIG

\*------------------------------*/

var siteURL = '';
var isHome = false;
var themeURL = "/wp-content/themes/energie-partagee-2";


// Activate resize events
var resizeEvent = true;
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

// Ajax
var ppp = 12; // Post per page
var pageNumber = 2;
var offsetProject = 1;
var limiteProjectLoading = 0;
/*------------------------------*\

    #FUNCTIONS

\*------------------------------*/

// Jquery OuterWidth() always with margin & padding

var oldOuterWidth = $.fn.outerWidth;
$.fn.outerWidth = function () { 
	return oldOuterWidth.apply(this, [true]);
};

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
			// Nav
			for (var i=0; i<nbNavItems; i++) {				
				pp_nav();
			}
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
        }
    },
	category: {
        init: function() {			
			initLoadMorePostsBtn();
        }
    },
	projets: {
        init: function() {			
			initGoogleMap();
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





/*------------------------------*\

    #RESIZE

    Is activated by vars in config.js

\*------------------------------*/

/**
 * MAIN RESIZE EVENT
 *
 */

function resize_handler() {	 
	// calc_windowW();	
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

/**
 * Add a notification display
 * Using : notify('message');	
 */	
var notify = function(message) {
	
	var $message;	
	
	if ( $('body').hasClass('single-projets') ) {
			$message = $('<div class="bullet-points bullet-points--white"><span></span></div><p class="notif-form" style="display:none;">' + message + '</p>');
	} else {
			$message = $('<p class="notif-form" style="display:none;">' + message + '</p>');
	}      

    $('.notification').append($message);
       $message.slideDown(300, function() {
      	if ( !$('body').hasClass('single-projets') && !$('body').hasClass('page-id-3224')) {
      		window.setTimeout(function() {
      		  $message.slideUp(300, function() {
      		    $message.remove();
      		  });
      		}, 10000);
      	}
    });
};	
// Init the google map
function initGoogleMap(){
	
	var mapContainer = document.getElementById("map");
	
	var latlng = new google.maps.LatLng(47.50,2.20);
	
	var mapOptions = {
        zoom: 6,
        scrollwheel: false,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        },
        mapTypeControl: false,
        streetViewControl: false,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    };	
		
	var map = new google.maps.Map(mapContainer,mapOptions);		
	
	
	
	loadMarkers(map);
}
// Load markers by JSON ajax custom request
function loadMarkers(map){	

	var str = 'action=get_json_map';
	
	$.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
			
			$.each(data, function(i){	
			
				var newLatLng = {lat: parseInt(data[i].latitude), lng: parseInt(data[i].longitude)};				
							
				var marker = new google.maps.Marker({
					position: newLatLng,
					map: map,
					title: data[i].title
				});				
				
				var markerContent = '<h1>'+data[i].title+'</h1>';
				markerContent += '<a hre="'+data[i].permalink+'">Consulter le projet</a>';
				
				marker.addListener('click', function() {
					onClickMarker(markerContent);
				});

        	});	
			
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false; 
	
}
// Event on click  on a marker
function onClickMarker(markerContent){	
	$('.fluxi-content').append(markerContent);
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
	if($('.accordion').length){
		$('.accordion .accordion__head').click( function(e) { 		 	
			$(this).parent().toggleClass('open').find('.accordion__content').slideToggle();		
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
function initContactForm(){

	$("#contact_ep").validate({
			rules: {
				email:{	email: true	},				
				prenom: { required: true },
				nom: { required: true },
				sujet: { required: true },
				message: { required: true },
				
			},
			messages: {			
				sujet: { required: "Veuillez sélectionner une réponse" },
				
			},
			submitHandler: function() {				
				sendMail();			
			}
		});	
	
	function sendMail(){
		if($('#submit.loading').length == 0 && $('#submit.sendok').length == 0){	
			$.ajax({
					url: themeURL+'/app/inc/inc_projet/send_contact.php',
					type: 'POST',
					data: $('form#contact_ep').serialize(),
					dataType: 'json',
					beforeSend : function() {					
						$('#submit').addClass('loading');
						$('#submit').val('');
					},
					success: function(json) {
						$('#submit').removeClass('loading').addClass('sendok');
						$('#submit').val('Envoyer');
						if(json.resultForm == 'yes') {                        	
							notify('<span class="valid-submit-form">Votre message à bien été envoyé. Merci</span>');						
						} else {							
							notify('<span class="error-submit-form">Il semble y avoir un problème dans l\'envoie de votre message. Vérifiez si tous les champs requis sont renseignés puis renvoyez le. Si le problème persiste, veuillez nous contacter.</span>');	
						}						
					},
                  error: function(){
						$('#submit').removeClass('loading');
                        notify('<span class="error-submit-form">Il semble y avoir un problème dans l\'envoie de votre message. Vérifiez si tous les champs requis sont renseignés puis renvoyez le. Si le problème persiste, veuillez nous contacter.</span>');
                  }          
			});
		}
	}
	
}
//*********************************************
    //   Soumettre un projet
    //*********************************************
	var typeEnergie, stadeProjet;
	
	if($('#soumettre_projet').length > 0){	
		
		// Datepicker
		var TODAY = new Date(2013,3,20,10,30);
		$('#mise_en_service').pickadate({
			monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
			weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
			today: 'aujourd\'hui',
			clear: 'effacer',
			formatSubmit: 'dd/mm/yy',
			close: 'Fermer'
		});
		
		// validation Js du form
		var messageRadio = "Veuillez sélectionner une réponse";
		
		$("#soumettre_projet").validate({
			rules: {
				email_contact:{	required: true,	email: true	},
				connu_comment: { required: true	},
				collectif: { required: true	},
				stade_projet: {	required: true },
				entite_porteuse: { required: true },
				projet_formalise: { required: true },
				actions_sensibilisation: { required: true }, 
				dispositions_securisant: { required: true },
				montant_financement: { required: true },
				projet_visible: { required: true },
				code_postal: { required: true, number: true },
				code_postal_contact: { number: true },
				tel_1_contact : { required: true, digits: true },
				tel_2_contact : { digits: true },
				puissance_prevue : { required: true, number: true },
				unites_production : { required: true, number: true },
				objectif_production : { number: true },
				montant_investissement : { required: true, number: true },
				montant_financement : { number: true, range: [50000, 500000] },
				fonds_disponibles : { number: true },
				part_endettement : { number: true, max: 100 },
				site_web_projet : { url: true }
			},
			messages: {				
				connu_comment: { required: messageRadio },
				collectif: { required: messageRadio },
				stade_projet: { required: messageRadio },
				entite_porteuse: { required: messageRadio },
				projet_formalise: { required: messageRadio },
				actions_sensibilisation: { required: messageRadio },
				dispositions_securisant: { required: messageRadio },
				montant_financement: { required: messageRadio },
				projet_visible: { required: messageRadio }
			},
			submitHandler: function() {				
				sendForm();			
			}
		});	
		
		function sendForm(){
			if($('#submit.loading').length == 0 && $('#submit.sendok').length == 0){	
			$.ajax({
					url: themeURL+'/app/inc/inc_projet/soumettre_projet.php',
					type: 'POST',
					data: $('form#soumettre_projet').serialize(),
					dataType: 'json',
					beforeSend : function() {
						//$('.valid-submit-form, .error-submit-form').hide('fast');
						//$('.navigation-form').append('<p class="ajax-loader"><img src="'+urlTheme+'/assets/images/ajax-loader.gif" /></p>');
						$('#submit').addClass('loading');
					},
					success: function(json) {
						//$('.ajax-loader').remove();
						$('#submit').removeClass('loading').addClass('sendok');
						if(json.resultForm == 'yes') {                        	
							notify('<span class="valid-submit-form">Merci, votre projet vient a été correctement ajouté. Nous vous contacterons prochainement avant de le faire apparaitre sur notre site internet.</span>');						
						} else {							
							notify('<span class="error-submit-form">Il semble y avoir un problème dans l\'envoie de votre formulaire. Vérifiez si tous les champs requis sont renseignés puis renvoyez le. Si le problème persiste, veuillez nous contacter.</span>');	
						}						
					},
                    error: function(){
						$('#submit').removeClass('loading');
                        notify('<span class="error-submit-form">Il semble y avoir un problème dans l\'envoie de votre formulaire. Vérifiez si tous les champs requis sont renseignés puis renvoyez le. Si le problème persiste, veuillez nous contacter.</span>');
                    }          
				});
			}
		}
	
		// affichage conditionnel
		typeEnergie = $('#source_energie').val();
		
		stadeProjet = $('input[name=stade_projet]').index($('input[name=stade_projet]:checked')) + 1;		
		
		hideShowForm();	
				
		$('#source_energie').change(function(){		
			typeEnergie = $(this).val();			
			if(typeEnergie == 14){
				$('#source_energie_detail').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#source_energie_detail').addClass('sub-hide-item').attr('disabled', true).val('');
			}			
			hideShowForm();	
		});
		
		$('input[name=stade_projet]').change(function(){		
			stadeProjet = $('input[name=stade_projet]').index(this);			
			stadeProjet = stadeProjet + 1;				
			hideShowForm();	
			//refreshWaypoints();	
		});	
		
		// champs obtionnels/conditionnels (si autres, si oui, etc...)		
		
		$('input[name=connu_comment]').change(function(){			
			if($('input[name=connu_comment]:checked').val() == "Autres"){
				$('#connu_autre').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#connu_autre').addClass('sub-hide-item').attr('disabled', true).val('');
			}
		});
		
		$('input[name=collectif]').change(function(){			
			if($('input[name=collectif]:checked').val() == "Autres"){
				$('#autre_collectif').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#autre_collectif').addClass('sub-hide-item').attr('disabled', true).val('');
			}
		});		
		
		$('input[name=entite_porteuse]').change(function(){			
			if($('input[name=entite_porteuse]:checked').val() == "oui"){
				$('#nom_entite_porteuse').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#nom_entite_porteuse').addClass('sub-hide-item').attr('disabled', true).val('');
			}
		});	
		
		/*$('input[name=projet_formalise]').change(function(){			
			if($('input[name=projet_formalise]:checked').val() == "Oui"){
				$('#fichier_projet_formalise').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#fichier_projet_formalise').addClass('sub-hide-item').attr('disabled', true);
				$('#fichier_projet_formalise').replaceWith( $('#fichier_projet_formalise').val('').clone( true ) );
			}
		});	*/
		
		$('input[name=actions_sensibilisation]').change(function(){			
			if($('input[name=actions_sensibilisation]:checked').val() == "oui"){
				$('#actions_sensibilisation_detail').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#actions_sensibilisation_detail').addClass('sub-hide-item').attr('disabled', true).val('');
			}
		});	
		
		$('input[name=dispositions_securisant]').change(function(){			
			if($('input[name=dispositions_securisant]:checked').val() == "oui"){
				$('#dispositions_securisant_detail').removeClass('sub-hide-item').attr('disabled', false);
			}
			else{
				$('#dispositions_securisant_detail').addClass('sub-hide-item').attr('disabled', true).val('');
			}
		});
		
		$('input[name=demande_financement]').change(function(){			
			if($('input[name=demande_financement]:checked').val() == "oui"){
				$('#montant_financement').removeClass('sub-hide-item').attr('disabled', false);
				$('#montant_financement_label').removeClass('sub-hide-item');
			}
			else{
				$('#montant_financement').addClass('sub-hide-item').attr('disabled', true).val('');
				$('#montant_financement_label').addClass('sub-hide-item');
			}
		});
		
		
	}
	
	function hideShowForm(){
		
		if(stadeProjet != "" && stadeProjet != 0){			
			
			if(stadeProjet == 2 ||  stadeProjet == 3){
					
				$('.item-1-6, .item-1-5, .item-1-4, .item-1-3, .item-2-6').removeClass('hide-item');
				
				disableCleaner();
			}
			
			else if(stadeProjet == 1){
								
				$('.item-1-6, .item-1-5, .item-1-4, .item-1-3').removeClass('hide-item');
				$('.item-2-6').addClass('hide-item');
				
				disableCleaner();
			}
			
			else if(stadeProjet == 4){
				
				$('.item-1-6, .item-1-5, .item-1-4, .item-2-6').removeClass('hide-item');		
				$('.item-1-3').addClass('hide-item');
				
				disableCleaner();
			}
			
			else if(stadeProjet == 5){
				
				$('.item-1-6, .item-1-5, .item-2-6').removeClass('hide-item');	
				$('.item-1-4, .item-1-3').addClass('hide-item');
				
				disableCleaner();
			}
			
			else if(stadeProjet == 6){
							
				$('.item-1-6, .item-2-6').removeClass('hide-item');					
				$('.item-1-5, .item-1-4, .item-1-3').addClass('hide-item');
				
				disableCleaner();
				
			}
			
			else{
				
				$('.item-1-6, .item-1-5, .item-1-4, .item-1-3, .item-2-6').addClass('hide-item');			
			}
			
			
		}	
			
		// type energie 
		if(typeEnergie != 12){
			$('.type-eco-energ').addClass('sub-hide-item');
			$('.type-non-eco-energ').removeClass('sub-hide-item');
			
			$('#puissance_prevue, #unites_production, #objectif_production').removeClass('hide-item').attr('disabled', false);			
			$('#objectif_economie').addClass('hide-item').attr('disabled', true).val('');
		}
		else{
			$('.type-eco-energ').removeClass('sub-hide-item');
			$('.type-non-eco-energ').addClass('sub-hide-item');
			
			$('#puissance_prevue, #unites_production, #objectif_production').addClass('hide-item').attr('disabled', true).val('');			
			$('#objectif_economie').removeClass('hide-item').attr('disabled', false);	
		}
		
		if(typeEnergie == 14){
			$('#source_energie_detail').removeClass('sub-hide-item').attr('disabled', false);
		}
		else{
			$('#source_energie_detail').addClass('sub-hide-item').attr('disabled', true).val('');
		}
		
		// champs autres etc...
		// connu comment
		if($('input[name=connu_comment]:checked').val() != "Autres"){
			$('#connu_autre').addClass('sub-hide-item').attr('disabled', true).val('');
		}
		else{
			$('#connu_autre').removeClass('sub-hide-item').attr('disabled', false);				
		}
		// collectif
		if($('input[name=collectif]:checked').val() != "Autres"){
			$('#autre_collectif').addClass('sub-hide-item').attr('disabled', true).val('');
		}
		else{
			$('#autre_collectif').removeClass('sub-hide-item').attr('disabled', false);				
		}
		// entite_porteuse
		if($('input[name=entite_porteuse]:checked').val() == "Autres"){
			$('#nom_entite_porteuse').removeClass('sub-hide-item').attr('disabled', false);
		}
		else{
			$('#nom_entite_porteuse').addClass('sub-hide-item').attr('disabled', true).val('');
		}
		
		// envoie de fichier formalisé
		/*if($('input[name=projet_formalise]:checked').val() == "Oui"){
			$('#fichier-projet_formalise').removeClass('sub-hide-item');
		}
		else{
			$('#fichier_projet_formalise').addClass('sub-hide-item');
			$('#fichier_projet_formalise').replaceWith( $('#fichier_projet_formalise').val('').clone( true ) );
		}*/
		// actions_sensibilisation
		if($('input[name=actions_sensibilisation]:checked').val() == "oui"){
			$('#actions_sensibilisation_detail').removeClass('sub-hide-item').attr('disabled', false);
		}
		else{
			$('#actions_sensibilisation_detail').addClass('sub-hide-item').attr('disabled', true).val('');
		}
		// dispositions_securisant
		if($('input[name=dispositions_securisant]:checked').val() == "oui"){
			$('#dispositions_securisant_detail').removeClass('sub-hide-item').attr('disabled', false);
		}
		else{
			$('#dispositions_securisant_detail').addClass('sub-hide-item').attr('disabled', true).val('');
		}
		// demande_financement
		if($('input[name=demande_financement]:checked').val() == "oui"){
			$('#montant_financement').removeClass('sub-hide-item').attr('disabled', false);
			$('#montant_financement_label').removeClass('sub-hide-item');
		}
		else{
			$('#montant_financement').addClass('sub-hide-item').attr('disabled', true).val('');
			$('#montant_financement_label').addClass('sub-hide-item');
		}
	}	
	
	function disableCleaner(){		
		// initialise les champs pour la validation (en fonction de l'état d'avancement du projet)				
		$('input:text.hide-item, textarea.hide-item').each(function( index ) {						
			$(this).attr('disabled', true);
			$(this).val('');			
		});
		
		$('input:radio.hide-item').each(function( index ) {			
			$(this).attr('disabled', true);
			$(this).prop('checked', false );			
		});
		
		$('select.hide-item').each(function( index ) {			
			$(this).attr('disabled', true);
			//$(this).val('');			
		});
		
		$('input:text, textarea, input:radio, select').not('.hide-item').each(function( index ) {			
			$(this).attr('disabled', false);
		});
	}
/* 
 * Load more projects
 * Return JSON
 */
function initLoadMoreProjectsBtn (){
	$('.js-more-project').attr('disabled',false);	
	$('.js-more-project').on( 'click', function ( e ) {		
		e.preventDefault();
		$('.js-more-project').attr('disabled',true);			
		loadMoreProjects();
	});
}

function loadMoreProjects(){	
	
    offsetProject = offsetProject + 2;
	limiteProjectLoading++;
	
    var str = 'offset='+offsetProject+'&action=more_project_ajax';
	
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
						
			$.each(data, function(i){
				
				var content ='<a class="card card-project is-flip-out" href="'+data[i].permalink+'"><div class="card__img"><img class="img-reponsive" src="'+data[i].image+'"><i class="card__icon icon-uniE60F"></i></div><div class="card__infos"><h1 class="card__title">'+data[i].title+'</h1><p class="p-ss">'+data[i].region+'</p></div></a>';
				
				if(i > 0){
					$('.trio-card .box .box__half:eq(1)').html('').append(content);
				}else{
					$('.trio-card .box .box__half:eq(0)').html('').append(content);
				}
				
        	});	
			
        	if(limiteProjectLoading < 2){
				$('.js-more-project').attr('disabled',false);
			}
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false; 
	
	
}



/* 
 * Load more news/event 
 * Return HTML
 */
function initLoadMorePostsBtn (){
	$('.js-more').on( 'click', function ( e ) {		
		e.preventDefault();
		$('.js-more').attr('disabled',true);
		
		var category = $(this).data('cat');		
		
		loadPosts(category);
	});
}

function loadPosts(category){
    pageNumber++;
    var str = '&cat=' + category + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length > 1){
                $('.fluxi-content .box').append($data);
                $('.js-more').attr('disabled',false);
            } else{
                $('.js-more').remove('disabled',true);
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false;
}




/* WP-JSON TEST
/*

function initLoadMoreBtn (){
	$('.load-more').on( 'click', function ( e ) {
		e.preventDefault();
		
		var category = $(this).data('cat');
		
		getPosts(category);
	});
}

function getPosts(category) {
    $.ajax({
        url: siteURL+'/wp-json/posts?filter[cat]=' + category + '&include[]=title&include[]=date&filter[posts_per_page]=12&filter[offset]=12',
        dataType: 'json',
        type: 'GET',
        success: function(data) {
			$('.fluxi-content').append('<h4 class="h4">— ' + data[0].title + '</h4>');
           // drawCountries(data);
			
        },
        error: function() {
			
            console.log('erreur JSON');
			
        }
    });
}

*/

	// VARS
	
	var ppItemsW = new Array();
	
	var logoW = $('.navbar__id').outerWidth();
	var buttonsW = $('.navbar__buttons').outerWidth();
	var nbNavItems = $('.nav__item').length;
	var activeItems = nbNavItems;
	var nbNavItemsNav1 = $('.nav__primary .nav__item').length;
	var nbNavItemsNav2 = $('.nav__secondary .nav__item').length;


	// RESIZE

	$(window).on('resize', function() {
	  pp_nav();
	});


	// PRIORITY PATTERN NAV

	function pp_nav() {
		calc_windowW();
		var navW;
		var remainW;
		var availableW;
		var navPad;
		get_data();		

		// Hamburger

		if (activeItems < nbNavItems) {
		  $('.hamburger').addClass('is-visible');
		} else {
		  $('.hamburger').removeClass('is-visible pp-visible');
		  $('.pp').removeClass('is-visible');
		}

		// Move items

		if (remainW < navW) {
			if ($('.nav__secondary .nav__item').length > 0) {
			  var $item =  $('.nav__secondary').children().last();
			} else {
			  var $item =  $('.nav__primary').children().last();
			}
			ppItemsW.push($item.outerWidth());
			$item.removeClass('is-active').prependTo('.pp').on('click', clicPPnavItem).off('click', clicNavItem);
			clicPPnavItem();
			activeItems--;
		} else {
			if (ppItemsW.length>0) {
				if (availableW > ppItemsW[ppItemsW.length-1]) {
					var $item = $('.pp .nav__item').first();
					if ($('.nav__primary .nav__item').length == nbNavItemsNav1) {
					  $item.first().appendTo('.nav__secondary');
					} else {
					  $item.first().appendTo('.nav__primary');
					}
					$item.removeClass('is-unfold').off('click', clicPPnavItem).on('click', clicNavItem);
					ppItemsW.pop();
					activeItems++;
				}
			}
		}

		// Get data

		function get_data() {
			var hamburgerW = 0;
			if ($('.hamburger').hasClass('is-visible')) {
				hamburgerW = 50;
			}
			navW = $('.nav__primary').innerWidth() + $('.nav__secondary').width();
			navbarPd = $('.navbar').css('padding-left').replace("px", "")*2;
			remainW = windowW - logoW - buttonsW - navbarPd - hamburgerW;
			availableW = remainW - navW;
		}
	}


	// SEARCH

	$('.js-toggle-search').on('click', toggleSearch);
	function toggleSearch() {
		if (!$('.navbar').hasClass('is-search')) {
			$('.navbar').addClass('is-search');
			setTimeout(function() { $('.nav__search__input').focus(); }, 1);
			$('.js-toggle-pp').removeClass('pp-visible');
			$('.pp').removeClass('is-visible');
			$('.no-pp .is-active').removeClass('is-active');
			$('.pp .is-unfold').removeClass('is-unfold');
		} else {
			$('.navbar').removeClass('is-search');
			for (var i=0; i<nbNavItems; i++) {
				pp_nav();
			}
		}
	}


	// CLIC EVENTS FOR TOUCH DEVICES

	if ($('body').hasClass('touch')) {
		$('.js-toggle-pp').click(function(){
			clearMenu();
			if (!$('.pp').hasClass('is-visible')) {
				$('.navbar__id').addClass('is-compact');
			}
			$(this).toggleClass('pp-visible');
			$('.pp').toggleClass('is-visible');
		})

		$('.no-pp .nav__item').on('click', clicNavItem);
	}

	function clicNavItem(e) {
		if (!$(e.target).hasClass('nav__item__title')) {
			return;
		}
		if ($(this).hasClass('is-active')) {
			clearMenu();
		} else {
			clearMenu();
			$(this).toggleClass('is-active');
			$('.pp').removeClass('is-visible');
			$('.js-toggle-pp').removeClass('pp-visible')
			$('.navbar__id').addClass('is-compact');
		}
	}

	function clicPPnavItem() {
	    $('.pp .is-unfold').removeClass('is-unfold');
	    $(this).addClass('is-unfold');
	}

	function clearMenu() {
		$('.no-pp .is-active').removeClass('is-active');
		$('.pp .is-unfold').removeClass('is-unfold');
		if (!$('.navbar').hasClass('stick-top')) {
			$('.navbar__id').removeClass('is-compact');
		}
	}

	// SIMULATION WAYPOINT

	$('.js-toggle').click(function(e){
	  $('.navbar').toggleClass('stick-top');
	  if (!$('.pp').hasClass('is-visible') && $('.no-pp .nav__item.is-active').length == 0) {
	  	$('.navbar__id').toggleClass('is-compact');
	  }
	  e.preventDefault();
	})