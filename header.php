<?php
/**
 * The Header
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]>    <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js lt-ie9> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="wrapper">

<?php if ( ot_get_option('responsive') != 'off' ) : ?>
	<aside id="sidemenu-container">
        <div id="sidemenu">
        <nav class="menu-mobile-container">
        <?php echo sp_mobile_navigation(); ?>
        </nav>
        </div>            	
    </aside> <!-- end #sidemenu-container -->
<?php endif; ?>

    <div id="content-container">

    <div class="navigation-overlay"></div>

    <header id="header">
        <div class="container clearfix">

            <div class="brand" role="banner">
                <?php if( !is_singular() ) echo '<h1>'; else echo '<h2>'; ?>
                
                <a href="<?php echo home_url() ?>/" title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                    <?php if(ot_get_option('custom-logo')) : ?>
                    <img src="<?php echo ot_get_option('custom-logo'); ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
                    <?php else: ?>
                    <span><?php bloginfo( 'name' ); ?></span>
                    <?php endif; ?>
                </a>
                
                <?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
            </div><!-- end .brand -->

            <div class="upload-cv"><a href="#postcv-form" id="upload-cv" class="button yellow">Upload Resume</a></div>

            <div class="menu-button">
                <div class="border-wrap">
                <span class="border-before"></span>
                <span class="border-main"></span>
                <span class="border-after"></span>
                </div>
                <div class="menu-title">Menu</div>
            </div> <!-- .menu-button -->
            
        </div><!-- .container .clearfix -->

        <nav id="primary-menu-container">
            <div class="container clearfix">
                <?php echo sp_main_navigation(); ?>
            </div>
        </nav><!-- .primary-nav .wrap -->
    </header><!-- end #header -->

