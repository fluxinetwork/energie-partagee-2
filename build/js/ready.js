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




