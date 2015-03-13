<?php
/**
 * The default template for displaying social sharing icon
 *
 */
?>
<?php 
    $twitter_user = ot_get_option('twitter-username');
?>
<div class="sharing">
    <span class="share-title">SHARE</span>
    <div class="default-sharing">
        <a class="sharing-buttons facebook" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( esc_url( get_the_permalink() ) ); ?>" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
            <div class="icon sprite-facebook"></div>
            <div class="but-text">Facebook</div>
        </a>
        <a class="sharing-buttons twitter" href="https://twitter.com/intent/tweet?text=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8'); ?>&url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>&via=<?php echo urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ); ?>" >
            <div class="icon sprite-twitter"></div>
            <div class="but-text">
                Twitter
            </div>
        </a>
        <script>window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));</script>
        
        <a class="sharing-buttons googleplus" href="http://plus.google.com/share?url=<?php echo urlencode( esc_url( get_permalink() ) ); ?>" onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;">
            <div class="icon sprite-googleplus"></div>
        </a>   
    </div>
</div>