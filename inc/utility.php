<?php
/* 타이틀 */
function slowalk_title() {
  wp_title( '|', true, 'right');
}

/* 레티나 이미지 */
function slowalk_retina_image( $filename, $ext = 'png', $alt ) {
  $src    = slowalk_get_image( $filename .    '.' . $ext );
  $srcset = slowalk_get_image( $filename . '@2x.' . $ext . ' 2x' );
  list( $src_width, $src_height ) = getimagesize( $src );
  $hwstring = image_hwstring( $src_width, $src_height );
  echo '<img src="'.$src.'" alt="'.$alt.'" '.$hwstring.'srcset="'.$srcset.'">';
}

/* 테마 디렉토리의 이미지파일 리턴 */
function slowalk_get_image( $image ) {
  return get_template_directory_uri() . '/images/' . $image;
}

/* 워드프레스 기본 요약 말줄임표 변경 */
function new_excerpt_more($more) {
  return '⋯';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* 워드프레스 기본 요약 글자수 변경 */
function new_excerpt_length($length) {
  return 150;
}
add_filter('excerpt_length', 'new_excerpt_length');

/* 커스텀 요약 생성 */
function slowalk_trim_excerpt($text = '') {
  /** wp-includes/formatting.php에서 wp_trim_excerpt() 함수를 복제 */
  $text = strip_shortcodes( $text );
  $text = apply_filters( 'the_content', $text );
  $text = str_replace(']]>', ']]&gt;', $text);
  $excerpt_length = apply_filters( 'excerpt_length', 55 );
  $excerpt_more = apply_filters( 'excerpt_more', ' ' . '&hellip;' );
  $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  return $text;
}

/* 원하는 한글 글자수만큼 자르기 - 한글 */
function slowalk_trim_utf8($str, $len, $checkmb=false, $tail='...') {
    preg_match_all('/[\xEA-\xED][\x80-\xFF]{2}|./', $str, $match);

    $m    = $match[0];
    $slen = strlen($str);  // length of source string
    $tlen = strlen($tail); // length of tail string
    $mlen = count($m); // length of matched characters
    
    if ($slen <= $len) return $str;
    if (!$checkmb && $mlen <= $len) return $str;
    
    $ret   = array();
    $count = 0;
    
    for ($i=0; $i < $len; $i++) {
        $count += ($checkmb && strlen($m[$i]) > 1)?2:1;
    
        if ($count + $tlen > $len) break;
        $ret[] = $m[$i];
    }
    
    return join('', $ret).$tail;
}
