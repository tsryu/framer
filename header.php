<!DOCTYPE html>
<html <?php language_attributes(); ?> ng-app="myApp">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title><?php slowalk_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo( 'name' ); ?> &mdash; 피드" href="<?php echo esc_url( get_feed_link() ); ?>">
  <?php wp_head(); ?>
  <meta name="naver-site-verification" content="9c21fe93f5182295d47ea8b721dba525e10874f1"/>
</head>

<body <?php body_class(); ?>>
<a class="skip-link sr-only" href="#content"><?php echo '본문으로 이동'; ?></a>

<header id="masthead" class="site-header" role="banner">
  <nav id="gnb-desktop" class="site-navigation gnb-desktop" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a id="brand" class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
          <svg class="logo" width="12" height="18" viewBox="0 0 12 18">
            <g fill="none" fill-rule="evenodd">
              <path class="logo-top" fill="#AEF" d="M0 0h12v6H6z"></path>
              <path class="logo-middle" fill="#0AF" d="M12 12H0V6h6z"></path>
              <path class="logo-bottom" fill="#04F" d="M6 18l-6-6h6z"></path>
            </g>
          </svg>
        </a>
      </div>
      <div class="navbar-collapse"><?php
        wp_nav_menu( array(
          'menu'    => 'global',
          'depth'             => 1,
          'container'         => false,
          'menu_class'        => 'nav navbar-nav no-style menu-global'
        ) ); 
        wp_nav_menu( array(
          'menu'    => 'external',
          'depth'             => 1,
          'container'         => false,
          'menu_class'        => 'nav navbar-nav no-style menu-external hidden-xs'
        ) ); ?>
      </div><!-- .navbar-collapse -->
    </div><!-- .container -->
  </nav>
</header><!-- .site-header -->

<main id="main" class="site-main" role="main">
  <div class="container">
  <?php //if ( ! is_home() && ! is_front_page() ) echo '<div class="container">'; ?>
