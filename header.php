<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aarsleff
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

    <script id="Cookiebot" src="https://consent.cookiebot.eu/uc.js" data-cbid="3c12d3f9-b220-4530-84f4-59dcc3abcbae" data-blockingmode="auto" type="text/javascript"></script>

    <script data-cookieconsent="ignore">
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("consent", "default", {
        ad_personalization: "denied",
        ad_storage: "denied",
        ad_user_data: "denied",
        analytics_storage: "denied",
        functionality_storage: "denied",
        personalization_storage: "denied",
        security_storage: "granted",
        wait_for_update: 500,
      });
      gtag("set", "ads_data_redaction", true);
      gtag("set", "url_passthrough", false);
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-TZJ9Z6T');</script>
    <!-- End Google Tag Manager -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src=https://www.googletagmanager.com/ns.html?id=GTM-TZJ9Z6T
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'aarsleff' ); ?></a>

    <header class="header" id="header">
        <div class="header__body container">
            <div class="header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img class="" src="<?php bloginfo('template_url'); ?>/assets/img/logo/Aarsleff_Logotype.svg" alt="logo">
                </a>
            </div>
            <nav class="navbar container">
                <div class="navbar-inner">

                            <div class="burger" id="burger">
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                                <span class="burger-line"></span>
                            </div>

                    <div class="navbar-block" id="menu">
                        <div class="menu__row">

                            <?php
                            // Navigation
                            wp_nav_menu(array( 'menu' => "Main menu",'menu_class' => "menu__list",'link_class'  => 'menu__link'));
                            ?>

                            <?php  do_action('wpml_add_language_selector');  ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

