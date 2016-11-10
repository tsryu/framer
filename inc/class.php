<?php
/* <body>: .singular.page-{slug}.ie */
function slowalk_body_class( $classes ) {
  global $is_IE;
  if ( $is_IE )
    $classes[] = 'ie';

  if ( is_singular() && ! is_home() && ! is_front_page() ) :
    $classes[] = 'singular';
    if ( ! is_single() && ! in_array(basename(get_permalink()), $classes) ) :
      $classes[] = 'page-'.basename(get_permalink());
    endif;
  endif;
  return $classes;
}
add_filter( 'body_class', 'slowalk_body_class' );

/* <article>: .has-post-thumbnail */
function slowalk_post_class( $classes ) {
  if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() )
    $classes[] = 'has-post-thumbnail';
  return $classes;
}
add_filter( 'post_class', 'slowalk_post_class' );

/* 검색폼: submit 버튼에 .screen-reader-text 추가 */
function slowalk_search_form_modify( $html ) {
  return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'slowalk_search_form_modify' );
