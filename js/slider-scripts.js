/*
 * MovingBoxes script
 */
 
// After Page Loads
jQuery(window).load(function() {

	jQuery("div#postSlider").movingBoxes({
		// Appearance
		startPanel   : 1,       // start with this panel
		reducedSize  : 1,       // non-current panel size: 90% of panel size
		fixedHeight  : true,    // if true, slider height set to max panel height; if false, slider height will auto adjust.
		
		// Behaviour
		initAnimation: true,    // if true, MovingBoxes will initialize, then animate into the starting slide (if not the first slide)
		stopAnimation: true,    // if true, movingBoxes will force the animation to complete immediately, if the user selects the next panel
		hashTags     : false,   // if true, hash tags are enabled
		wrap         : false,   // if true, the panel will "wrap" (now loops in v2.2, or appears as if there are infinite panels)
		buildNav     : true,    // if true, navigation links will be added
		navFormatter : function(){ return "&#9679;"; },      // function which returns the navigation text for each panel
		easing       : 'linear',   // anything other than "linear" or "swing" requires the easing plugin
		
		// Times
		speed              : 1000, 	// animation time in milliseconds
		delayBeforeAnimate : 0, 	// time to delay in milliseconds before MovingBoxes animates to the selected panel
		
		// Selectors & classes
		currentPanel : 'current', // current panel class
		tooltipClass : 'tooltip', // added to the navigation, but the title attribute is blank unless the link text-indent is negative
		disabled     : 'disabled',// class added to arrows that are disabled (left arrow when on first panel, right arrow on last panel)
		
		// Callbacks
		preinit         : null,   // callback after the basic MovingBoxes structure has been built; before "initialized"
		initialized     : null,   // callback when MovingBoxes has completed initialization
		initChange      : null,   // callback upon change panel initialization
		beforeAnimation : null,   // callback before any animation occurs
		completed       : null,   // callback after animation completes
		
		// deprecated options - but still used to keep the plugin backwards compatible
		// and allow resizing the overall width and panel width dynamically (i.e. on window resize)
		// width        : 800,    // overall width of movingBoxes (not including navigation arrows)
		panelWidth   : 1,         // current panel width adjusted to 50% of overall width
	});
	
	// Show the #postSliderWrapper after the page loads
	jQuery("div#postSlider").css('visibility','');
});