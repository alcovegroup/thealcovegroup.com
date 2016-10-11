<?php if ( post_custom('use_video_background') ): ?>
        console.log("video background is in use");
        if ($(window).width() > responsiveWidth) {
          console.log("and screen size is larger than mobile");

        var pageHasLoaded = false;

        window.addEventListener('load', eventWindowLoaded, false);
        function eventWindowLoaded() {
          var videoElement = document.getElementById("videoPreload");
          videoElement.addEventListener('progress',updateLoadingStatus,false);
        }

        function updateLoadingStatus() {
          if (pageHasLoaded) { return }
          var loadingStatus = document.getElementById("loadingStatus");
          var videoElement = document.getElementById("videoPreload");
          var percentLoaded = parseInt(((videoElement.buffered.end(0) / videoElement.duration) * 100));
          if (percentLoaded > 3) {
            console.log("page loaded over 3%");
            playVideo();
            pageHasLoaded = true;
          }
          document.getElementById("loadingStatus").innerHTML =   percentLoaded + '%';
        }

        function playVideo() {
          var videoElement = document.getElementById("videoPreload");
          videoElement.play();
          $('#pageHide').css({
            "opacity": "1",
            "pointer-events": "auto"
          });
          pageHasLoaded = false;
        }

        } else {
          console.log("and screen size is mobile: " + responsiveWidth);
          showImagePage();
        }
        <?php endif; ?>

        <?php if ( !post_custom('use_video_background') ): ?>
        console.log("video background is not in use");
        showImagePage();
        <?php endif; ?>