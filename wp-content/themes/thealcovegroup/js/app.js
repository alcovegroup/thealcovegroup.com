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
	var darkenOverlay = $('#darken-overlay');
	var windowScrollPos = window.pageYOffset;
	var advanceFormButton = $('#advance-form');

	var remUnit = parseInt($('html').css("font-size"));
    var responsiveWidth = 37.70588*remUnit;
	
	menuToggle.attr("checked", false);
	
	setTimeout(function(){
		darkenOverlay.css("height", docHeight);
	}, 0);
	

	scrollIncrement();

	function scrollIncrement(ev){
		windowScrollPos = window.pageYOffset;
		var $header = $('#header');
		var $logoImg = $('img.logo');
	    if (window.pageYOffset > 40) {
	    	console.log("translated");
	    	if (!$header.hasClass("minimized")) {
	    		$header.addClass("minimized");
	    		// $logoImg.attr( "src", "../img/temp-logo-mark.png" );
	    	}
	    } else {
	    	if ($header.hasClass("minimized")) {
	    		$header.removeClass("minimized");
	    		// $logoImg.attr( "src", "../img/temp-logo-full.png" );
	    	}
	    }
	}
	window.onscroll = scrollIncrement;
	
	menuButtons.add('a[href="http://mls.liquinas.com/#featured-home-0"]').on("mousedown", function(event){
		event.preventDefault();
	});
	menuButtons.add('a[href="http://mls.liquinas.com/#featured-home-0"]').on("click", function(target){
		if (menuExpanded == false) {
			// console.log("menu has been expanded");
			menuPanel.offset({ top: windowScrollPos});
			// pageBody.css("overflow-y", "hidden");
			menuExpanded = true;
			// darkenOverlay.toggleClass( "exposed" );
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
			// console.log("menu has been collapsed");
			menuPanel.offset({ top: 0});
			// pageBody.css("overflow-y", "auto");
			menuExpanded = false;
			console.log("this");
			console.log(this);
			if (this == $('a[href="http://mls.liquinas.com/#featured-home-0"]')) {
				console.log("conditional met");
				menuToggle.attr("checked", false);
			}
			// darkenOverlay.toggleClass( "exposed" );
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

	// $('a[href="http://mls.liquinas.com/#featured-home-0"]').on("click", function(){
 //      console.log("anchor link clicked");
      
 //      //duplicate menu close script
 //      menuPanel.offset({ top: 0});
 //      menuExpanded = false;
 //      $( "#darken-overlay" ).remove();

 //      if ($(window).width() < responsiveWidth) {
 //        pageBody.css("overflow-y", "auto");
 //      } else {
 //        if ( $('.home')[0] || $('.page-template-about')[0] ) {
 //          $.fn.fullpage.setAllowScrolling(true);
 //        } else {
 //          pageBody.css("overflow-y", "auto");
 //        }
 //      }
 //      //end duplicate menu close script

 //    });

	function menuButtonClick() {
		if (menuExpanded == false) {
			// console.log("menu has been expanded");
			menuPanel.offset({ top: windowScrollPos});
			pageBody.css("overflow-y", "hidden");
			menuExpanded = true;
			darkenOverlay.toggleClass( "exposed" );
		} else {
			// console.log("menu has been collapsed");
			menuPanel.offset({ top: 0});
			pageBody.css("overflow-y", "auto");
			menuExpanded = false;
			darkenOverlay.toggleClass( "exposed" );
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









