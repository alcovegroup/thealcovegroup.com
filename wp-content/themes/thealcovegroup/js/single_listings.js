jQuery(function ($) {
	$(document).ready(function() {

  var inputID = $('input[name="MLS-id"]');
  var inputURL = $('input[name="listing-url"]');
  inputID.val("MLS ID of this listing");
  inputURL.val("Website URL of this listing");

  $(document).foundation({
	abide : {
	  live_validate : false, // validate the form as you go
	  validate_on_blur : false, // validate whenever you focus/blur on an input field
	  focus_on_invalid : false // automatically bring the focus to an invalid input field
	}
  });

  if ($(window).width() > 767) {
	$('.slickslide').on('init', function(event, slick){
	  //find number of photos
	  var thumbs = $('.slick-dots').children('li');
	  var numThumbs = thumbs.length;
	  //find size of photo thumb
	  var thumbWidth = $(thumbs[0]).width();
	  var thumbHeight = $(thumbs[0]).height();
	  //find total width of track
	  var containerWidth = $('#home-gallery-row').width();
	  var totalTrackWidth = Math.floor(numThumbs * thumbWidth) + thumbWidth;
	  var posX = 0;
	  var numThumbsInVP = Math.floor(containerWidth / thumbWidth);
	  var numThumbsOffScreen = numThumbs - numThumbsInVP;
	  //wrap slick-dots in track
	  $('.slick-dots').wrap(function() {
		return "<div class='slick-dots-track' style='height: " + thumbHeight + "px;'></div>";
	  });
	  //set width of dots ul to total width & height of 1 thumb
	  $('.slick-dots').css({ "height": thumbHeight, "width": totalTrackWidth });

	  //if the thumb track is less than the container width, we need arrows
	  if (!(totalTrackWidth < containerWidth)) {
		$('.slick-dots-track').append("<span id='scroll-left' class='slick-dots-track-arrow'><span class='icon-icon-arrow-down arrow-prev'></span></span>");
		$('.slick-dots-track').append("<span id='scroll-right' class='slick-dots-track-arrow'><span class='icon-icon-arrow-down arrow-next'></span></span>");
		$('#scroll-left').on("click", function(){
		  console.log("left arrow clicked");
		  if (posX < 0) {
			$('.slick-dots').css("-webkit-transform", "translateX(" + (posX + thumbWidth) + "px)");
			$('.slick-dots').css("-moz-transform", "translateX(" + (posX + thumbWidth) + "px)");
			$('.slick-dots').css("-o-transform", "translateX(" + (posX + thumbWidth) + "px)");
			$('.slick-dots').css("transform", "translateX(" + (posX + thumbWidth) + "px)");
			posX = (posX + thumbWidth);
		  }
		});
		$('#scroll-right').on("click", function(){
		  console.log("right arrow clicked");
		  if (posX > (numThumbsOffScreen * thumbWidth * -1)) {
			$('.slick-dots').css("-webkit-transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
			$('.slick-dots').css("-moz-transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
			$('.slick-dots').css("-o-transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
			$('.slick-dots').css("transform", "translateX(" + (posX + thumbWidth*-1.2) + "px)");
			posX = (posX + thumbWidth*-1);
		  }
		});
	  } //end if track size conditional

	}); //end slick init function
  } //end if window width conditional

		$('.slickslide').slick({
			dots: true,
			arrows: true,
			infinite: true,
			speed: 200,
			prevArrow:'<span class="icon-icon-arrow-down arrow-prev"></span>',
			nextArrow:'<span class="icon-icon-arrow-down arrow-next"></span>',
			fade: false,
			slide: 'li',
			cssEase: 'ease-in-out',
			centerMode: true,
			slidesToShow: 1,
			variableWidth: true,
			autoplay: false,
			autoplaySpeed: 4000,
			responsive: [{
				breakpoint: 768,
				settings: {
					arrows: false,
					centerMode: false,
					centerPadding: '40px',
					variableWidth: false,
					slidesToShow: 1,
					dots: false
				}
			}],
			customPaging: function (slider, i) {
		return '<span class="slick-thumb-highlight""></span>'
			  + "<button class='tab' "
			  + "style='background-image: "
			  + $('.slick-thumbs li:nth-child(' + (i + 1) + ')').css('background-image')
			  +  ";'></button>"
	}
		});
	});
});
function formSubmission(event) {
	$('#inquire-form').on('invalid.fndtn.abide', function () {
	  var invalid_fields = $(this).find('[data-invalid]');
	  // console.log("invalid fields: ");
	  // console.log(invalid_fields);
	}).on('valid.fndtn.abide', function () {
	  console.log('valid!');
	  __ss_noform.push(['submit', null, '7c39939e-318b-4fb1-a3cf-93d47759eb2a']);
	  $('#inquire-form').hide();
	  $('#thank-you-message').show();
	});
}