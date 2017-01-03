<div class="row">
  <div class="small-12 medium-8 medium-offset-2 columns footer-content">
    <?php if ( get_option('global_footer_message') ): ?>
    <h4><?php echo get_option('global_footer_message'); ?></h4>
    <?php endif; ?>

    <form id="footerSubscribe">
      <input type="checkbox" id="newsletter-checkbox" value="newsletter-opt-in" name="newsletter-opt-in" style="display: none;" checked>
      <input type="text" placeholder="Email Address*" name="footer-email-subscribe" required/>
      <input type="submit" class="small" value="Subscribe" />
    </form>
    <script type="text/javascript">
        var __ss_noform = __ss_noform || [];
        __ss_noform.push(['baseURI', 'https://app-3QEHIZGEXU.marketingautomation.services/webforms/receivePostback/MzYwtzQwMDG0BAA/']);
        __ss_noform.push(['form', 'footerSubscribe', '3575c290-c774-4ae3-b045-c53b68ef65d8']);
    </script>
    <script type="text/javascript" src="https://koi-3QEHIZGEXU.marketingautomation.services/client/noform.js?ver=1.24" ></script>
    <ul class="social-icons">
      
    <?php if ( get_option('global_company_email') ): ?>
    <li><a href="mailto:<?php echo get_option('global_company_email'); ?>"><span class="icon-ring"></span><span class="icon-icon-email"></span></a></li>
    <?php endif; ?>

    <?php if ( get_option('global_company_phone') ): ?>
    <li><a href="<?php echo get_option('global_company_phone'); ?>"><span class="icon-ring"></span><span class="icon-icon-phone"></span></a></li>
    <?php endif; ?>

    <?php if ( get_option('global_company_facebook') ): ?>
    <li><a href="<?php echo get_option('global_company_facebook'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-facebook"></span></a></li>
    <?php endif; ?>

    <?php if ( get_option('global_company_linkedin') ): ?>
    <li><a href="<?php echo get_option('global_company_linkedin'); ?>" target="_blank"><span class="icon-ring"></span><span class="icon-icon-linkedin"></span></a></li>
    <?php endif; ?>

    </ul>
    <?php wp_nav_menu( array('container' => false, 'menu_class' => 'menu', 'theme_location' => 'footer' ) ); ?>
    <p class="copyright"><?php echo comicpress_copyright(); ?></p>
  </div>
</div>