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
// Map
var nbMakers = 0;
var nbShowMakers = 0;
var gmarkers = [];
var activateFilters = false;
var filterCat = 'all_cat';
var filterStade = 'all_cat';
var iconsProjetMap = {
	eolie: { icon: themeURL + '/app/img/icon-marker-eolien.png'},
	bioma: { icon: themeURL + '/app/img/icon-marker-biomasse.png' },
	solai: { icon: themeURL + '/app/img/icon-marker-solaire.png' },
	micro: { icon: themeURL + '/app/img/icon-marker-micro.png' },
	geoth: { icon: themeURL + '/app/img/icon-marker-geoth.png' },
	econo: { icon: themeURL + '/app/img/icon-marker-econo.png' }
};	