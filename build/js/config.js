/*------------------------------*\

    #CONFIG

\*------------------------------*/

var siteURL = '';
var isHome = false;

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
