<?php
/* 시작 */
function slowalk_before_post($post = true) {
  if ( $post ) : ?>
    <article <?php post_class(); ?>><?php
  else : ?>
    <article class="hentry"><?php
  endif;
}

/* 끝 */
function slowalk_after_post() { ?>
  </article><?php
}

/* 제목 */
function slowalk_the_title() {
  $title = trim(get_the_title());
  if ( ! $title ) $title = '(제목이 없는 글)';
  echo $title;
}

/* 썸네일 */
function slowalk_post_thumbnail($size = 'thumbnail') {
  if ( post_password_required() && ! is_singular() ) : /* 비밀 글 */ ?>
    <a class="post-thumbnail" href="<?php the_permalink(); ?>">
      <?php slowalk_the_post_thumbnail_placeholder( 'thumbnail', 'thumbnail-lock' ); ?>
    </a><?php
    return;
  endif;

  if ( is_singular() ) : /* 글, 페이지, 첨부파일 */
    if ( has_post_thumbnail() ) : ?>
      <div class="post-thumbnail">
        <?php the_post_thumbnail( 'full' ); ?>
      </div><?php
    endif;
  elseif ( is_home() ) : /* 홈화면 */
    if ( has_post_thumbnail() ) :
      the_post_thumbnail( $size );
    else :
      slowalk_the_post_thumbnail_placeholder( $size );
    endif; 
  else : /* 보관함 */ ?>
    <a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php
      if ( has_post_thumbnail() ) :
        the_post_thumbnail( $size );
      else :
        slowalk_the_post_thumbnail_placeholder( $size );
      endif; ?>
    </a><?php

  endif;
}

/* 썸네일: 플레이스홀더 */
function slowalk_the_post_thumbnail_placeholder($size = 'thumbnail', $filename = 'thumbnail-post', $ext = 'png') {
  $src    = get_template_directory_uri().'/images/'.$filename.'.'.$ext;
  $srcset = get_template_directory_uri().'/images/'.$filename.'@2x.'.$ext.' 2x';
  $alt = get_the_title();
  list( $src_width, $src_height ) = getimagesize( $src );
  //list( $src_width, $src_height ) = getimagesize( '/home/youthgov/public_html/wp-content/themes/seoulyg/images/'. $filename.'.'.$ext );
  list( $width, $height ) = image_constrain_size_for_editor( $src_width, $src_height, $size );
  $hwstring = image_hwstring( $width, $height );
  $class = 'attachment-'.$size.' wp-post-image';
  echo '<img src="'.$src.'" alt="'.$alt.'" '.$hwstring.'class="'.$class.'" srcset="'.$srcset.'">';
}

/* 썸네일: 레티나 */
function slowalk_the_post_thumbnail_srcset($size1x, $size2x) {
  $attr = array( 'srcset' => slowalk_get_post_thumbnail_src( $size2x ).' 2x' );
  the_post_thumbnail( $size1x, $attr );
}

/* 썸네일: 소스 */
function slowalk_get_post_thumbnail_src($size = 'full') {
  $post_thumbnail_id = get_post_thumbnail_id();
  return slowalk_get_attachment_image_src( $post_thumbnail_id, $size );
}

/* 첨부 이미지: 소스 */
function slowalk_get_attachment_image_src($attachment_id, $size = 'full') {
  $image = wp_get_attachment_image_src( $attachment_id, $size );
  list( $src, $width, $height ) = $image;
  return $src;
}

/* 메타 */
function slowalk_entry_meta($meta = null) {
  if ( ! $meta ) return;

  if ( $meta == 'category' ) :
    $categories_list = get_the_category_list( ', ' );
    if ( $categories_list ) : ?>
      <span class="cat-links"><?php echo $categories_list; ?></span><?php
    endif;

  elseif ( $meta == 'tag' ) :
    $tags_list = get_the_tag_list( '', ', ', '' );
    if ( $tags_list ) : ?>
      <span class="tag-links"><?php echo $tags_list; ?></span><?php
    endif;

  elseif ( $meta == 'date' ) : ?>
    <span class="posted-on">
      <time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
        <?php echo esc_html( get_the_date('Y.m.d') ); ?>
      </time>
    </span><?php

  elseif ( $meta == 'author' ) : ?>
    <span class="author"><?php echo esc_html( get_the_author() ); ?></span><?php

  endif;
}
/* 메타 (커스텀필드) */
function slowalk_post_meta( $meta ) {
  echo slowalk_get_post_meta( $meta );
}
function slowalk_get_post_meta( $meta ) {
  $value = get_post_meta( get_the_ID(), $meta, true );
  return $value;
}

/* 편집 링크 */
function slowalk_edit_post_link($right = false) {
  $before = '(<span class="edit-link">';
  $after = '</span>)';
  if ( $right ) :
    $before = '<div class="edit-link text-right">';
    $after = '</div>';
  endif;
  edit_post_link( '편집', $before, $after );
}

/* 내비게이션 버튼 */
function slowalk_post_nav() {
  $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );
  if ( ! $next && ! $previous ) return; ?>
  <nav class="navigation post-navigation" role="navigation">
    <h1 class="screen-reader-text"><?php echo 'Post navigation'; ?></h1>
    <div class="nav-links"><?php
      if ( is_attachment() ) : /* 첨부파일 페이지일 때 */ ?>
        <div class="published-in"><?php
          previous_post_link( '%link', '발행 위치: ' . '%title' ); ?>
        </div><?php
      else : /* 첨부파일 페이지가 아닐 때 */
        previous_post_link( '%link', '이전 글');
        next_post_link( '%link', '다음 글' );
      endif; ?>
    </div>
  </nav><?php
}