/*
Copyright (c) 2008-2012, www.redips.net All rights reserved.
Code licensed under the BSD License: http://www.redips.net/license/
http://www.redips.net/javascript/maintain-scroll-position/
Version 1.1.0
Feb 8, 2012.
*/

/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false */

/* enable strict mode */
"use strict";

// define functions
var myFormSubmit;


// prepare scroll position and submit form
myFormSubmit = function () {
	// set reference to the form
	var frm = document.forms[0]; 
	// set scroll position to the hidden form element
	frm.scroll.value = my_scroll();
	// submit form
	frm.submit();
};

            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }