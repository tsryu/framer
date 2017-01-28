<?php
/* <title> */
function slowalk_wp_title( $title, $sep ) {
  if ( is_feed() )
    return $title;

  $title            = slowalk_page_title();
  $site_name        = get_bloginfo( 'name', 'display' );
  $site_description = get_bloginfo( 'description', 'display' );

  if ( is_home() || is_front_page() ) :
    if ( ! $site_description ) : return;
    else : $title = "$title $sep $site_description";
    endif;

  else :
    $title = "$title $sep $site_name";

  endif;
  return $title;
}
add_filter( 'wp_title', 'slowalk_wp_title', 10, 2 );

/* <head>: IE8 대응, 메타, 파비콘 */
function slowalk_add_opengraph_namespace( $input ) {
  return $input.' prefix="og: http://ogp.me/ns#"';
}
add_filter( 'language_attributes', 'slowalk_add_opengraph_namespace' );
function slowalk_head() {
  if (WP_ENV != 'development') :
    echo '<!--[if lt IE 9]>';
    echo '<script src="' . esc_url( get_template_directory_uri() ) . '/js/html5shiv.min.js"></script>';
    echo '<script src="' . esc_url( get_template_directory_uri() ) . '/js/respond.min.js"></script>';
    echo '<![endif]-->';
  endif; ?>

  <!-- 검색엔진최적화 -->
  <?php if ( is_404() ) : ?>
    <meta name="robots" content="noindex,follow">
    <meta property="og:title" content="<?php slowalk_meta( 'title' ); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_search() ) : ?>
    <meta name="robots" content="noindex,follow">
    <link rel="canonical" href="<?php slowalk_meta( 'url' ); ?>">
    <meta property="og:title" content="<?php slowalk_meta( 'title' ); ?>">
    <meta property="og:url" content="<?php slowalk_meta( 'url' ); ?>">
    <meta property="og:type" content="object">

  <?php elseif ( is_archive() ) : ?>
    <meta name="robots" content="noindex,follow">
    <meta name="description" content="<?php echo get_field('site_description', 'option');?>">
    <link rel="canonical" href="<?php slowalk_meta( 'url' ); ?>">
    <meta property="og:title" content="<?php slowalk_meta( 'title' ); ?>">
    <meta property="og:url" content="<?php slowalk_meta( 'url' ); ?>">
    <meta property="og:type" content="object">
    <meta property="og:description" content="<?php echo get_field('og_description', 'option');?>">

  <?php elseif ( is_singular() ) : ?>
    <meta property="og:title" content="<?php slowalk_meta( 'title' ); ?>">
    <meta property="og:url" content="<?php slowalk_meta( 'url' ); ?>">
    <meta property="og:type" content="article">
    <meta name="description" content="<?php echo get_field('site_description', 'option');?>">
    <meta property="og:description" content="<?php echo get_field('og_description', 'option');?>">
      <?php if ( is_single() ) : ?>
      <meta property="article:section" content="<?php slowalk_meta( 'section' ); ?>">
      <?php foreach ( slowalk_meta( 'tags' ) as $tag ) : ?>
        <meta property="article:tag" content="<?php echo $tag->name; ?>">
      <?php endforeach; ?>
    <?php endif; ?>
    <meta property="article:published_time" content="<?php slowalk_meta( 'time' ); ?>">
    <meta property="article:author" content="<?php slowalk_meta( 'author' ); ?>">

  <?php else : ?>
    <link rel="canonical" href="<?php slowalk_meta( 'url' ); ?>">
    <meta name="description" content="<?php echo get_field('site_description', 'option');?>">
    <meta property="og:description" content="<?php echo get_field('og_description', 'option');?>">
    <meta property="og:type" content="website">

  <?php endif; ?>

  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:image" content="<?php slowalk_meta( 'image' ); ?>">
  <?php if ( is_singular() ) : ?>
    <?php foreach ( slowalk_meta( 'attachment_images' ) as $attachment_image ) : ?>
      <meta property="og:image" content="<?php echo $attachment_image; ?>">
    <?php endforeach; ?>
  <?php endif; ?>
  <meta property="og:locale" content="<?php bloginfo( 'language' ); ?>">
  <meta name="keywords" content="<?php echo get_field('site_keywords', 'option');?>">
  <!-- / 검색엔진최적화 -->

  <!-- 파비콘 -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/images/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri();?>/images/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri();?>/images/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php echo get_template_directory_uri();?>/images/favicons/manifest.json">
<link rel="mask-icon" href="<?php echo get_template_directory_uri();?>/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
  <!-- / 파비콘 --><?php
}
add_action('wp_head', 'slowalk_head');

/* <head>: 청소 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_generator' );
