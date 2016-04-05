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
var pageNumber = 1;
var offsetProject = 1;
var limiteProjectLoading = 0;

// Projects Map
var nbMakers = 0;
var nbShowMakers = 0;
var gmarkers = [];
var activateFilters = false;
var filterCat = 'all_cat';
var filterStade = 'all_cat';
/*
var iconsProjetMap = {
	eolie: { icon: themeURL + '/app/img/icon-marker-eolien.png'},
	bioma: { icon: themeURL + '/app/img/icon-marker-biomasse.png' },
	solai: { icon: themeURL + '/app/img/icon-marker-solaire.png' },
	micro: { icon: themeURL + '/app/img/icon-marker-micro.png' },
	geoth: { icon: themeURL + '/app/img/icon-marker-geoth.png' },
	econo: { icon: themeURL + '/app/img/icon-marker-econo.png' }
};	
*/
var map;
var prevCardMapId;
var previousMarker;
var previousNrj;
var isOpenMarker = false;
var markerShadow;
var iconShadow = {
	url: themeURL+'/app/img/marker-shadow.png',
	size: new google.maps.Size(38, 38),
	origin: new google.maps.Point(0, 0),
	anchor: new google.maps.Point(34, 34)
};

var iconsSelectProjectsMap = {
	eolie: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 1,
      	strokeWeight: 15,
      	fillColor: '#5ab1bb',
      	fillOpacity: 1, 
    },
	bioma: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 1,
      	strokeWeight: 15,
      	fillColor: '#83ab00',
      	fillOpacity: 1, 
    },
	solai: { 
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 1,
      	strokeWeight: 15,
      	fillColor: '#e9af00',
      	fillOpacity: 1, 
    },
	micro: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 1,
      	strokeWeight: 15,
      	fillColor: '#5268b9',
      	fillOpacity: 1, 
    },
	geoth: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 1,
      	strokeWeight: 15,
      	fillColor: '#e7511e',
      	fillOpacity: 1, 
    },
	econo: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 1,
      	strokeWeight: 15,
      	fillColor: '#b7115b',
      	fillOpacity: 1, 
    }
};

var iconsProjectsMap = {
	eolie: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 0,
      	strokeWeight: 15,
      	fillColor: '#5ab1bb',
      	fillOpacity: 1, 
    },
	bioma: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 0,
      	strokeWeight: 15,
      	fillColor: '#83ab00',
      	fillOpacity: 1, 
    },
	solai: { 
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 0,
      	strokeWeight: 15,
      	fillColor: '#e9af00',
      	fillOpacity: 1, 
    },
	micro: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 0,
      	strokeWeight: 15,
      	fillColor: '#5268b9',
      	fillOpacity: 1, 
    },
	geoth: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 0,
      	strokeWeight: 15,
      	fillColor: '#e7511e',
      	fillOpacity: 1, 
    },
	econo: {  
		path: google.maps.SymbolPath.CIRCLE, 
		scale: 22,
		strokeColor: '#ffffff',
      	strokeOpacity: 0,
      	strokeWeight: 15,
      	fillColor: '#b7115b',
      	fillOpacity: 1, 
    }
};

