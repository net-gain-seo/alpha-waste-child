<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
   <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.png" />
    <?php wp_head(); ?>
    <meta name="google-site-verification" content="9bb4nCt0nni3MbMEcz279hK-ZAgXQEqqgb4nmhsmocU"/>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://web.archive.org/web/20171003140544/https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-81612730-1', 'auto');
    ga('send', 'pageview');

    </script>
</head>

<body <?php body_class(); ?>>

<header class="container-fluid site-header">
    <div class="container flex-header">
        <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt=""></a></div>
        <div class="stickylogo"><a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo-sticky.png" alt=""></a></div>
        <div class="header-block">
            <div class="inner-block">
                <div class="topbar">
                  <div class="phone"><a href="tel:101634838540">Call: 01634 838 540</a></div>
                  <div class="cart"><a href="<?php echo home_url(); ?>/basket"><img src="<?php bloginfo('template_url'); ?>/img/BasketIcon.png" alt="Cart" width="40px" height="35px"/>BASKET</a></div>
                </div>
                <div class="header-nav">
                    <div class="container padding0">
                          <div class="mobile-icons">
                            <a href="javascript:void(0);" id="navToggle" class="nav-toggle">
                                <i class="fa fa-bars"></i>
                                <span>MENU</span>
                            </a>
                            <a href="tel:101634838540" class="nav-phone">
                                <i class="fa fa-phone"></i>
                                <span>CALL</span>
                            </a>

                            <a href="<?php echo home_url(); ?>/contact/" class="nav-contact">
                                <i class="fa fa-envelope"></i>
                                <span>CONTACT</span>
                            </a>
                        </div>
                        <nav id="mainNav" class="mobile-nav" role="navigation">
                          <a href="javascript:void(0);" class="get-quote" data-toggle="modal" data-target="#popForm">REQUEST A QUOTE</a>
                           <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '' ) ); ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
