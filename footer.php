</main>

<footer class="container-fluid site-footer">
    <div class="container flex-footer">
        <div class="f-item phone-assoc">
            <div class="social">
                <a href="https://www.facebook.com/AlphaWasteSolutions/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/facebookicon.png" width="45px" alt=""></a>
                <a href="https://www.instagram.com/alphawaste_solutions/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/instagramicon.png" width="45px" alt=""></a>
                <a href="https://ca.linkedin.com/company/alpha-waste-solutions-limited" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/linkedinicon.png" width="45px" alt=""></a>
            </div>
        </div>
        <div class="f-item phone">
            <a href="tel:4401634838540">Tel: 01634 838 540</a><br/>
            <a class="email" href="mailto:enquiries@awsltduk.com">enquiries@awsltduk.com</a>
        </div>
        <div class="f-item hours">
          <p>Business Hours<br/>
          Monday to Friday  8:00am to 5:00pm</p>
        </div>
        <div class="f-item address">
          <h3>Alpha Waste Solutions Ltd.</h3>
          <p>Unit 22 Rochester Trade Park,<br/>
          Maidstone Road, Rochester,<br/>
          Kent   ME1 3QY</p>
        </div>
        <div class="f-item copyright">Copyright &copy; <?php echo date("Y"); ?> Alpha Waste. All rights reserved | <a href="/privacy-policy/" class="whiteText" alt="Privacy Policy">Privacy Policy</a> | <a href="/general-trading-terms-conditions/" class="whiteText" alt="general trading terms conditions">Terms & Conditions</a></div>

        <!---div class="f-item netgain">Website Designed by <a href="http://www.netgainseo.com/" target="_blank"><img src="<?php // bloginfo('template_url'); ?>/img/netgain.png" alt=""></a></div------>
    </div>
</footer>
<div class="modal fade popover-form" id="popForm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header popover-header">
                <h3 class="modal-title">REQUEST A QUOTE</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode( '[contact-form-7 id="168" title="Popout Form"]' ); ?>
            </div>
            <div class="modal-footer hidden-sm-up">

            </div>
        </div>
    </div>
</div>

<div class="modal fade popover-form" id="bulkForm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header popover-header">
                <h3 class="modal-title">REQUEST BULK ORDER</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode( '[contact-form-7 id="984" title="Bulk Order Form"]' ); ?>
            </div>
            <div class="modal-footer hidden-sm-up">

            </div>
        </div>
    </div>
</div>

<a href="#" class="scrollToTop">&uarr;</a>
<div id="refContainer" class="container" style="visibility: hidden;"></div>
<div id="openNavOverlay"></div>
<div id="closeNav" class="close-nav">Close <i class="fa fa-times"></i></button></div>
<?php wp_footer(); ?>
</body>
</html>
