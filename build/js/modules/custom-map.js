/*
 * Init single project Map
 * - Add a dom container "map"
 * - mapOptions = { zoom: 7, scrollwheel: false, panControl: true}
 */
function initSingleMap(){
	//console.log('Init Google Map Obj for "Single project"');
	
	var mapContainer = document.getElementById("map");
	mapContainer.className += 'loader';
	
	var latitude = parseInt($('#map').data('lat'));
	var longitude = parseInt($('#map').data('lon'));
	
	var latlng = new google.maps.LatLng(latitude,longitude);
	var newLatLng = {lat: latitude, lng: longitude};
	
	var categoryNRJ = $('#map').data('cat');
	// Cut string to escape "-"
	categoryNRJ = categoryNRJ.substring(0, 5);	
	
	var title = $('#map').data('title');
	
	var mapOptions = {
        zoom: 7,
        scrollwheel: false,
        panControl: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL
        },
        mapTypeControl: false,
        streetViewControl: false,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP 
    };
	
	var map = new google.maps.Map(mapContainer,mapOptions);	
	
	var marker = new google.maps.Marker({
		position: newLatLng,
		clickable: true,
		map: map,
		title: title,
		icon: iconsSelectProjectsMap[categoryNRJ]
	});	

	markerShadow = new MarkerShadow(marker.getPosition(), iconShadow, map);	
}


/*
 * Init Projects Map
 * - Add a dom container
 * - latlng = new google.maps.LatLng(47.50,2.20);
 * - activateFilters : default = false
 * - mapOptions = { zoom: 6, scrollwheel: false, panControl: true}
 */
function initProjectsMap(){
	
	//console.log('Init Google Map Obj for "Projects Map"');
	
	var mapContainer = document.getElementById("map");	

	var latlng = new google.maps.LatLng(47.50,2.20);
	
	activateFilters = true;	
	
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
	
	loadGoogleMap(mapContainer, mapOptions);	
}
/* Init the google map
 *  mapContainer = DOM element | mapOptions = option array
 */
function loadGoogleMap(mapContainer, mapOptions){	
	
	//console.log('Load Google Map Obj');
		
	var map = new google.maps.Map(mapContainer,mapOptions);	
	
	mapContainer.className += 'loader';
	
	loadMarkers(map);
}

/* Load markers by JSON ajax custom request
 * map = Google map object
 * filterCat : default = 'all_cat' / String : cat_slug
 */
function loadMarkers(map){
	
	//console.log('loadMarkers '+filterCat);	
		
	// Params : suppress_filters | post_type | posts_per_page | post_status
	var str = 'action=get_json_map&category='+filterCat;
	
	$.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: ajax_object.ajax_url,
        data: str,
        success: function(data){	
			//console.log('Markers loaded for : '+filterCat);
			// Remove previous markers
			//removeMarkers();
			customMakers(map, data);
			
			//$('#map').removeClass('loader');			
        },
        error : function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

    });
    return false; 
	
}

function customMakers(map, data){
	
	//console.log('Custom Makers ');
	
	nbMakers = Object.keys(data).length;	
	
	$.each(data, function(i){		
		
		// If it's a project
		if(data[i].postType == 'projets'){		
				
			var newLatLng = {lat: parseInt(data[i].latitude), lng: parseInt(data[i].longitude)};
			
			var categoryNRJ = data[i].catSlug;
			// Cut string to escape "-"
			categoryNRJ =  categoryNRJ.substring(0, 5);		
									
			var marker = new google.maps.Marker({
				position: newLatLng,
				map: map,
				title: data[i].title,
				icon: iconsProjectsMap[categoryNRJ],
				category : data[i].catSlug,
				stade : data[i].stadeSlug
			});		
				
			var markerContent = '<article class="card-map c-'+categoryNRJ+'">'; 
				markerContent += '<header class="card card-project">';
	            	markerContent += '<div class="card__img"><span class="tag">'+data[i].stadeName+'</span><img src="'+data[i].image+'" alt="'+data[i].title+'"></div>';
	            	markerContent += '<div class="card__infos"><h1 class="card__title">'+data[i].title+'</h1></div>';
	            markerContent += '</header>';

	            markerContent += '<div class="p-details">';
		            markerContent += '<div class="p-details__nrg"><i class="icon-'+data[i].catSlug+'_100"></i></div>';

		        	markerContent += '<ul class="p-details__infos">';
		        		markerContent += '<li class="p-details__infos__loca"><strong>'+data[i].city+'</strong><span>'+data[i].region+'</span></li>';
		          		markerContent += '<li class="p-details__infos__prod"><strong>'+data[i].equiPui+' '+data[i].typeUnit+'</strong><span>'+data[i].prod+' '+data[i].prodUnit+'</span></li>';
		        	markerContent += '</ul>';

		        	markerContent += '<p class="p-details__equi p-ss">Produit la consommation annuelle de '+data[i].equiPro+' foyers.</p>';
	    		markerContent += '</div>';

				markerContent += '<a class="link-cta" href="'+data[i].permalink+'"><i class="icon-chevronright_32"></i><span>Voir ce projet</span></a>';

			markerContent += '</article>';

				
			marker.addListener('click', function() {
				onClickMarker(map,marker,markerContent);					
			});
			
			gmarkers.push(marker);			
			
			//console.log(marker);
			
			// Active filters
			if(i==nbMakers-1 && activateFilters){
				// Init all filters once if activateFilters = true
				initFilters(map);
				activateFilters=false;
				centerMapOnMarkers(map);
			}			
			
		}
		
		// End each
   });	
		
}

// Event on click  on a marker
function onClickMarker(map,marker,markerContent){

	if (markerShadow && markerShadow.setPosition) {
          markerShadow.setPosition(marker.getPosition());
        } else {
          markerShadow = new MarkerShadow(marker.getPosition(), iconShadow, map);
        }

	$('.cards-map').html(markerContent);
}

function initFilters(map){	

	//console.log('Init filters');
	
	$('.first.map-filters button').click(function(e){
		
		var $this = $(this);
		filterCat = $this.data('filter');
		
		if(!$this.hasClass('js-f-active')){
			
			$('.first.map-filters .js-f-active').toggleClass('js-f-active');
			$this.addClass('js-f-active');	
			
			for (i = 0; i < gmarkers.length; i++) {						
				// If is same category or category not picked
				if (gmarkers[i].category == filterCat || filterCat.length === 0){ 
					if(gmarkers[i].stade == filterStade || filterStade == 'all_cat'){
						gmarkers[i].setVisible(true);					
					}
				}
				// Categories don't match 
				else{ 
					gmarkers[i].setVisible(false);
				}
			}		
		
		}else{
			$this.toggleClass('js-f-active');
			resetNrjFilter();	
		}
		
		centerMapOnMarkers(map);		
	});	
	
	$('.second.map-filters button').click(function(e){		
	
		var $this = $(this);					
		filterStade = $this.data('filter');
		
		if(!$this.hasClass('js-f-active')){
			
			$('.second.map-filters .js-f-active').toggleClass('js-f-active');
			$this.addClass('js-f-active');
			
			for (i = 0; i < gmarkers.length; i++) {			
				if (gmarkers[i].stade == filterStade || filterStade.length === 0) {
					if(gmarkers[i].category == filterCat || filterCat == 'all_cat'){
						gmarkers[i].setVisible(true);									
					}
				}else {
					gmarkers[i].setVisible(false);
				}				
			}
		}else{
			$this.toggleClass('js-f-active');
			resetStadeFilter();	
		}		
		centerMapOnMarkers(map);
	});
	
}

function resetNrjFilter(){
	for (i = 0; i < gmarkers.length; i++) {
		if (gmarkers[i].category != filterCat ) {			
			if(gmarkers[i].stade == filterStade || filterStade == 'all_cat'){
				gmarkers[i].setVisible(true);
			}			
		}			
		if(i == gmarkers.length-1){
			filterCat = 'all_cat';
		}	
	}		
}
function resetStadeFilter(){
	for (i = 0; i < gmarkers.length; i++) {
		if (gmarkers[i].stade != filterStade) {		
			if(gmarkers[i].category == filterCat || filterCat == 'all_cat'){
				gmarkers[i].setVisible(true);
			}
		}	
		if(i == gmarkers.length-1){
			filterStade = 'all_cat';
		}	
	}	
}

function centerMapOnMarkers(map){
	nbShowMakers = nbMakers;		
	var LatLngList = new Array ();
	var bounds = new google.maps.LatLngBounds ();
	// Bind all marker's positions
	for (i = 0; i < gmarkers.length; i++) {
		if(gmarkers[i].visible)
		LatLngList.push(gmarkers[i].getPosition());
		else
		nbShowMakers--;			
	}	
	//  And increase the bounds to take this point
	for (var j = 0, LtLgLen = LatLngList.length; j < LtLgLen; j++) {	  
		bounds.extend (LatLngList[j]);
	}
	
	if(nbShowMakers >= 3){		
		map.fitBounds (bounds);		
	}else if(nbShowMakers == 2){		
		map.setZoom(6); 
		map.setCenter(bounds.getCenter());
	}else if(nbShowMakers == 1){		
		map.setZoom(7);
		map.setCenter(bounds.getCenter());
	}
}

function removeMarkers() {	
	//console.log('Remove All Markers');	
	 for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }   
}



/*
 * Marker shadow prototype
 * 
 */
MarkerShadow.prototype = new google.maps.OverlayView();
MarkerShadow.prototype.setPosition = function(latlng) {
    this.posn_ = latlng;
    this.draw();
  }
  /** @constructor */

function MarkerShadow(position, options, map) {

    // Initialize all properties.
    this.posn_ = position;
    this.map_ = map;
    if (typeof(options) == "string") {
      this.image = options;
    } else {
      this.options_ = options;
      if (!!options.size) this.size_ = options.size;
      if (!!options.url) this.image_ = options.url;
    }

    // Define a property to hold the image's div. We'll
    // actually create this div upon receipt of the onAdd()
    // method so we'll leave it null for now.
    this.div_ = null;

    // Explicitly call setMap on this overlay.
    this.setMap(map);
  }
  /**
   * onAdd is called when the map's panes are ready and the overlay has been
   * added to the map.
   */
MarkerShadow.prototype.onAdd = function() {
  // if no url, return, nothing to do.
  if (!this.image_) return;
  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = this.options_.size.x + 'px';
  img.style.height = this.options_.size.y + 'px';
  img.style.position = 'absolute';
  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayShadow.appendChild(div);
};

MarkerShadow.prototype.draw = function() {
  // if no url, return, nothing to do.
  if (!this.image_) return;
  // We use the coordinates of the overlay to peg it to the correct position 
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  var posn = overlayProjection.fromLatLngToDivPixel(this.posn_);

  // Resize the image's div to fit the indicated dimensions.
  if (!this.div_) return;
  var div = this.div_;
  if (!!this.options_.anchor) {
    div.style.left = Math.floor(posn.x - this.options_.anchor.x) + 'px';
    div.style.top = Math.floor(posn.y - this.options_.anchor.y) + 'px';
  }
  if (!!this.options_.size) {
    div.style.width = this.size_.x + 'px';
    div.style.height = this.size_.y + 'px';
  }
};

// The onRemove() method will be called automatically from the API if
// we ever set the overlay's map property to 'null'.
MarkerShadow.prototype.onRemove = function() {
  if (!this.div_) return;
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};

