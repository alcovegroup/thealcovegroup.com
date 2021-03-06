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
	var featuredHomesAnchor = $('a[href="http://mls.liquinas.com/#featured-home-0"]')[0];
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

	if( /iPad/i.test(navigator.userAgent) ) {
		pageBody.addClass("ipad-fs-fix");
	}

	function scrollIncrement(){
		windowScrollPos = window.pageYOffset;
		var $header = $('#header');
		var $logoImg = $('img.logo');
		if (window.pageYOffset > 40) {
			if (!$header.hasClass("minimized")) {
				$header.addClass("minimized");
			}
		} else {
			if ($header.hasClass("minimized")) {
				$header.removeClass("minimized");
			}
		}
	}
	
	if (useOnScroll) {
		scrollIncrement()
		window.onscroll = scrollIncrement;
	}
	

	menuButtons.add(featuredHomesAnchor).on("mousedown", function(event){
		event.preventDefault();
	});
	menuButtons.add(featuredHomesAnchor).on("click", function(target){
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
			if (this == featuredHomesAnchor) {
				menuToggle.attr("checked", false);
			}
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
			menuPanel.offset({ top: windowScrollPos});
			pageBody.css("overflow-y", "hidden");
			menuExpanded = true;
			darkenOverlay.toggleClass( "exposed" );
		} else {
			menuPanel.offset({ top: 0});
			pageBody.css("overflow-y", "auto");
			menuExpanded = false;
			darkenOverlay.toggleClass( "exposed" );
		}
	}

	$('.commanator').each(function() {
		var x = $(this).val();
		$(this).val(addCommas(x));
		$(this).on('keyup', function () {
			var x = $(this).val();
			$(this).val(addCommas(x));
		});
	});

	$('.js_money').each(function() {
		var x = $(this).val();
		$(this).val(addMoneySign(x));
		$(this).on('keyup', function () {
			var x = $(this).val();
			$(this).val(addMoneySign(x));
		});
	});

});

function addCommas(x)
{
	//remove commas
	retVal = x ? x.replace(/\$/g, '') : '';
	retVal = retVal.replace(/,/g, '');
	//apply formatting
	theReturn = retVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	if(retVal > 0) {
		return theReturn;
	} else {
		return "";
	}
}

function addMoneySign(x)
{
	//remove commas
	retVal = x ? x.replace(/\$/g, '') : '';
	retVal = retVal.replace(/,/g, '');
	//apply formatting
	theReturn = retVal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	if(retVal > 0) {
		return "$" + theReturn;
	} else {
		return "";
	}
}