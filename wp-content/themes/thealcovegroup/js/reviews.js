// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs

jQuery(function($) {

    $(document).foundation();

    var $reviewsMax = '10';
    var $zillowEndpoint = 'https://www.zillow.com/webservice/ProReviews.htm?zws-id=X1-ZWz1gky7op8emj_4u6i7&screenname=' + $zillowUser + '&count='+ $reviewsMax +'&output=json';
    
    $.ajax({
        url: $zillowEndpoint
    }).done(function(data) {
		renderInfo(data.response.results.proInfo);
		renderReviews(data.response.results.proReviews.review);
    });

    function renderInfo(infoData){
    	var $realtorName = $('#realtorName');
    	var $realtorURL = $('#realtorURL');
    	var $reviewsAve = $('#reviewsAve');
    	var $realtorHeader = $('#realtorHeader');
    	var $reviewsCount = $('#reviewsCount');
    	var $zillowLogo = $('#zillowLogo');
    	var $realtorImage = $('#realtorImage');
    	$realtorHeader[0].style.visibility = "visible";
    	$reviewsAve[0].innerHTML = infoData.avgRating;
    	$reviewsCount[0].innerHTML = infoData.reviewCount;
    	$realtorName[0].innerHTML = infoData.name;
    	$realtorURL[0].href = infoData.profileURL;
    	$zillowLogo[0].href = infoData.profileURL;
    	$realtorImage[0].src = infoData.photo;
    }

    function renderReviews(reviewData){
    	var $zillowReviewsList = $('#zillowReviews')[0];
    	var output = "";
    	for (i = 0; i < reviewData.length; i++) {
    		var starsAry = [];
	    	for (k = 0; k < reviewData[i].rating; k++) {
	    		starsAry.push('<span class="icon-icon-star"></span>');
	    	}
    		output += '<li class="zillow-review-item">'
            +'<div class="zillow-review-ui-row">'
            +' <!-- review.rating -->'
            +'  <ul class="zillow-stars-holder">'
            + starsAry.join(' ')
            +' </ul>'
            +' <div class="zillow-review-date">'
            + reviewData[i].reviewDate
            + '</div>'
            + '</div>'
            + '<p>'
            + reviewData[i].description
            + '</p>'
           	+ '</li>';
    	}
    	$zillowReviewsList.innerHTML = output;

    }

});