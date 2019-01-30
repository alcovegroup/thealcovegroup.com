	<?php wp_footer(); ?>

	<?php if ( is_front_page() ): ?>
      </div> <!-- End of page hide wrapper -->
    <?php endif; ?>

    <?php if ( get_site_url() === "http://staging.thealcovegroup.com" || get_site_url() === "http://staging.thealcovegroup.com/paradise-valley" ) { ?>
    	<script type="text/javascript">
		var _ss = _ss || [];
		_ss.push(['_setDomain', 'https://koi-3QEHIZGEXU.marketingautomation.services/net']);
		_ss.push(['_setAccount', 'KOI-1ZPCSUA3M']);
		_ss.push(['_trackPageView']);
		(function() {
		    var ss = document.createElement('script');
		    ss.type = 'text/javascript'; ss.async = true;

		    ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'koi-3QEHIZGEXU.marketingautomation.services/client/ss.js?ver=1.1.1';
		    var scr = document.getElementsByTagName('script')[0];
		    scr.parentNode.insertBefore(ss, scr);
		})();
		</script>
    <?php } ?>
	
  </body>
</html>
