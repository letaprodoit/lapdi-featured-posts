/*
 * MovingBoxes script
 */

jQuery(window).load(function() {

	jQuery("div#postSlider").movingBoxes({
		autoScroll	 : true,
		scrollSpeed	 : 7000,
		startPanel   : 1,      // start with this panel
		width        : 865,    // overall width of movingBoxes (not including navigation arrows)
		panelWidth   : .96,    // current panel width adjusted to 70% of overall width
		reducedSize  : 1,    // non-current panel size: 80% of panel size
		speed        : 1000,   // animation time in milliseconds
		fixedHeight  : true,   // if true, slider height set to max panel height; if false, slider height will auto adjust.
		wrap         : false,   	// if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
		easing       : 'linear',  	// anything other than "linear" or "swing" requires the easing plugin
		hashTags     : false,      	// if true, hash tags are enabled
		buildNav     : true,   		// if true, navigation links will be added
		navFormatter : function(){ return "&#9679;"; } // function which returns the navigation text for each panel
		//navFormatter : function(index, panel){ return panel.find('div.entry-title a').text(); }  // function which gets nav text from span inside the panel header
	});
	
	// if everything loaded properly then increase the size of the #postSliderWrapper
	jQuery("div#postSliderWrapper").css('height','350px');
});