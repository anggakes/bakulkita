;(function($, window, document, undefined) {
	"use strict";

	/*============================*/
	/* INIT */
	/*============================*/

	var swipers = [], winScr, _isresponsive, smPoint = 768, mdPoint = 992, lgPoint = 1200, addPoint = 1600, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

	/**
	 *
	 * PageCalculations function
	 * @since 1.0.0
	 * @version 1.0.1
	 * @var winW
	 * @var winH
	 * @var winS
	 * @var pageCalculations
	 * @var onEvent
	 **/
	if (typeof pageCalculations !== 'function') {

		var winW, winH, winS, pageCalculations,onEvent = window.addEventListener;

		pageCalculations = function(func){
			
			winW = window.innerWidth;
			winH = window.innerHeight;
			winS = document.body.scrollTop;

			if (!func) return;

			onEvent('load', func, true); // window onload
			onEvent('resize', func, true); // window resize
			onEvent("orientationchange", func, false); // window orientationchange

		}// end pageCalculations

		pageCalculations(function(){
			pageCalculations();
		});

	}


	/***********************************/
	/* WINDOW SCROLL */
	/**********************************/

	$(window).scroll(function() {

	});

})(jQuery, window, document);
