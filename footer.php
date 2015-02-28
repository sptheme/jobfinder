    <footer id="footer">
    <?php if ( ot_get_option( 'callout-footer' ) ): ?>    
        <div class="callout-footer">
            <div class="container clearfix">
                <?php
                    $page = get_post( ot_get_option( 'callout-footer' ) );
                    $content = apply_filters('the_content', $page->post_content);
                ?>
                <h3><?php echo $page->post_title; ?></h3>
                <?php echo $content; ?>
                <a id="post-job" href="#postjob-form" class="button green">Post a Job</a>
            </div>
        </div> <!-- .quick-contact -->
    <?php endif; ?>    

        
        <div class="footer-sidebar">
            <div class="container clearfix">
                <div id="widget-profile" class="widget">
                    <?php
                        $page = get_post( ot_get_option( 'profile-highlight' ) );
                        $content = apply_filters('the_content', $page->post_content);
                    ?>
                    <div class="widget-title"><h4><?php echo $page->post_title; ?></h4></div>
                    <?php echo $content; ?>
                </div>
                <div id="widget-address" class="widget">
                    <?php
                        $page = get_post( ot_get_option( 'contact-info' ) );
                        $content = apply_filters('the_content', $page->post_content);
                    ?>
                    <div class="widget-title"><h4><?php echo $page->post_title; ?></h4></div>
                    <?php echo $content; ?>
                </div>
                 <div id="widget-social-links" class="widget">
                    <div class="widget-title"><h4><?php echo ot_get_option( 'follow-txt' ); ?></h4></div>
                    <?php if ( ot_get_option( 'facebook-link' ) ) : ?>
                    <a href="<?php echo ot_get_option( 'facebook-link' ); ?>" target="_blank" class="icon-facebook-squared"></a>
                    <?php endif; ?>
                    <?php if ( ot_get_option( 'twitter-link' ) ) : ?>
                    <a href="<?php echo ot_get_option( 'twitter-link' ); ?>" target="_blank" class="icon-twitter"></a>
                    <?php endif; ?>
                    <?php if ( ot_get_option( 'linkedin-link' ) ) : ?>
                    <a href="<?php echo ot_get_option( 'linkedin-link' ); ?>" target="_blank" class="icon-linkedin"></a>
                    <?php endif; ?>
                    <?php if ( ot_get_option( 'gplus-link' ) ) : ?>
                    <a href="<?php echo ot_get_option( 'gplus-link' ); ?>" target="_blank" class="icon-gplus"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        

        
        <div class="copyright">
            <div class="container clearfix">
                <?php if ( ot_get_option( 'copyright' ) ): ?>
                    <?php echo ot_get_option( 'copyright' ); ?>
                <?php else: ?>
                    <?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', SP_TEXT_DOMAIN ); ?>
                <?php endif; ?>
            </div><!-- .container .clearfix -->
        </div><!--/.copyright-->
        
    </footer><!-- #footer -->

	</div> <!-- end #content-container -->
</div> <!-- #wrapper -->

<div id="postjob-form" class="mfp-hide white-popup-block job-form">
    <?php $page = get_post(ot_get_option('postjob-form')); ?>
    <h3 class="heading"><?php echo $page->post_title; ?></h3>
    <?php $content = apply_filters('the_content', $page->post_content); 
    echo $content; ?>
</div> <!-- #postjob-form -->

<div id="postcv-form" class="mfp-hide white-popup-block job-form">
    <?php $page = get_post(ot_get_option('postcv-form')); ?>
    <h3 class="heading"><?php echo $page->post_title; ?></h3>
    <?php $content = apply_filters('the_content', $page->post_content); 
    echo $content; ?>
</div> <!-- #postcv-form -->

<?php wp_footer(); ?>

</body>
</html>