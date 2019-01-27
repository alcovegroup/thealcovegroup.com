// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

jQuery(function ($) {

	$(document).foundation();

	// if( /iPhone|iPad|iPod/i.test(navigator.userAgent) ) {
		//browser detection
	// }


	
	var windowHeight = $(window).height();
	setTimeout(function(){
		$('.home #hero, .home .featured-home').css("height", windowHeight);
	}, 0);

	var docHeight = $(document).height();
	var pageBody = $('body');
	var menuToggle = $('input#menu-toggle');
	var menuPanel = $('#menu-frame');
	var menuButtons = $('.js-menu-btn');
	var menuExpanded = false;
	var contentFrame = $('#content-frame');
	var windowScrollPos = window.pageYOffset;
	var advanceFormButton = $('#advance-form');

	var remUnit = parseInt($('html').css("font-size"));
    var responsiveWidth = 37.70588*remUnit;
	
	menuToggle.attr("checked", false);

	if( /iPad/i.test(navigator.userAgent) ) {
		pageBody.addClass("ipad-fs-fix");
	}

	scrollIncrement();

	function scrollIncrement(ev){
		windowScrollPos = window.pageYOffset;
		var $header = $('#header');
		var $logoImg = $('img.logo');
	    if (window.pageYOffset > 40) {
	    	console.log("translated");
	    	if (!$header.hasClass("minimized")) {
	    		$header.addClass("minimized");
	    	}
	    } else {
	    	if ($header.hasClass("minimized")) {
	    		$header.removeClass("minimized");
	    	}
	    }
	}
	window.onscroll = scrollIncrement;
	
	menuButtons.on("mousedown", function(event){
		event.preventDefault();
	});
	menuButtons.on("click", function(){
		if (menuExpanded == false) {
			menuPanel.offset({ top: windowScrollPos});
			menuExpanded = true;
			contentFrame.append( "<div id='darken-overlay'></div>" );

			if ($(window).width() < responsiveWidth) {
				pageBody.css("overflow-y", "hidden");
			} else {
				if ( $('.home')[0] || $('.page-template-about')[0] ) {
					$.fn.fullpage.setAllowScrolling(false);
				} else {
					pageBody.css("overflow-y", "hidden");
				}
			}

		} else {
			menuPanel.offset({ top: 0});
			menuExpanded = false;
			$( "#darken-overlay" ).remove();

			if ($(window).width() < responsiveWidth) {
				pageBody.css("overflow-y", "auto");
			} else {
				if ( $('.home')[0] || $('.page-template-about')[0] ) {
					$.fn.fullpage.setAllowScrolling(true);
				} else {
					pageBody.css("overflow-y", "auto");
				}
			}
		}

	});

	function menuButtonClick() {
		if (menuExpanded == false) {
			// console.log("menu has been expanded");
			menuPanel.offset({ top: windowScrollPos});
			pageBody.css("overflow-y", "hidden");
			menuExpanded = true;
			// darkenOverlay.toggleClass( "exposed" );
		} else {
			// console.log("menu has been collapsed");
			menuPanel.offset({ top: 0});
			pageBody.css("overflow-y", "auto");
			menuExpanded = false;
			// darkenOverlay.toggleClass( "exposed" );
		}
	}

	// var featuredHomesLink = $('a[href="index.html"]');
 //    featuredHomesLink.on( "click", function(e){
 //    	e.preventDefault();
 //    	if (menuToggle.prop( "checked" )) {
 //    		menuToggle.prop("checked",false);
 //    	}
 //    	menuButtonClick();
 //    } );



});









