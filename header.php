<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title><?php slowalk_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo( 'name' ); ?> &mdash; 피드" href="<?php echo esc_url( get_feed_link() ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link sr-only" href="#content"><?php echo '본문으로 이동'; ?></a>

<header id="masthead" class="site-header" role="banner">
  <nav id="gnb-desktop" class="site-navigation gnb hidden-xs" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a id="brand" class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
          <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/brand.png">
        </a>
      </div>

      <div class="navbar-collapse"><?php
        wp_nav_menu( array(
          'theme_location'    => 'gnb',
          'depth'             => 2,
          'container'         => false,
          'menu_class'        => 'nav navbar-nav no-style'
        ) ); ?>
      </div><!-- .navbar-collapse -->
    </div><!-- .container -->
  </nav>
  
  <nav id="gnb-mobile" class="site-navigation gnb visible-xs" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle">
          <span class="sr-only">메뉴 열기</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a id="brand" class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
          <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/brand.png">
        </a>
      </div><!-- .navbar-header -->

      <div class="navbar-collapse" id="gnb-collapse">
        <header class="navbar-collapse-header">
          <span class="title">menu</span>
          <div class="navbar-toggle-close"><span class="sr-only">메뉴 닫기</span></div>
          <!-- 
          <button type="button" class="navbar-toggle">
            <span class="sr-only">메뉴 토글</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          -->
        </header>
        <?php
        wp_nav_menu( array(
          'theme_location'    => 'gnb',
          'depth'             => 3,
          'container'         => false,
          'menu_class'        => 'nav navbar-nav no-style'
        ) );?>
      </div>
    </div><!-- .container -->
  </nav>


</header><!-- .site-header -->

<main id="main" class="site-main" role="main">
  <div class="container">
  <?php //if ( ! is_home() && ! is_front_page() ) echo '<div class="container">'; ?>
