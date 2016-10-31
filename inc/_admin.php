<?php
// Hide ACF
// add_filter('acf/settings/show_admin', '__return_false'); // ver.5
// function remove_acf_menu() // ver.4
// {
//  // provide a list of usernames who can edit custom field definitions here
//  $admins = array( 
//    'admin', 
//    'johndoe'
//  );
//  // get the current user
//  $current_user = wp_get_current_user();
//  // match and remove if needed
//  if( !in_array( $current_user->user_login, $admins ) )
//  {
//    remove_menu_page('edit.php?post_type=acf');
//  }
// }
// add_action( 'admin_menu', 'remove_acf_menu', 999 );

// 아래한글(hwp) 업로드
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
  $existing_mimes['hwp'] = 'application/hangul';
  return $existing_mimes;
}

// 관리자 글목록 썸네일 표시
if (function_exists( 'add_theme_support' )){
  add_image_size( 'admin-thumb', 200, 200 ); // 100 pixels wide (and unlimited height)
  add_filter('manage_posts_columns', 'posts_columns', 5);
  add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
  add_filter('manage_pages_columns', 'posts_columns', 5);
  add_action('manage_pages_custom_column', 'posts_custom_columns', 5, 2);
}
function posts_columns($defaults){
  $defaults['wps_post_thumbs'] = __('Thumbs');
  return $defaults;
}
function posts_custom_columns($column_name, $id){
  if($column_name === 'wps_post_thumbs'){
    echo the_post_thumbnail( 'admin-thumb', array( 'class' => 'img-responsive' ) );
  }
}

// 관리자 글목록 : 커스텀타입 taxonomy 필터 
function add_taxonomy_filters() {
  global $typenow;

  // an array of all the taxonomyies you want to display. Use the taxonomy name or slug
  $taxonomies = array('taxo_name');

  // must set this to the post type you want the filter(s) displayed on
  if( $typenow == 'type_name' ){

    foreach ($taxonomies as $tax_slug) {
      $tax_obj = get_taxonomy($tax_slug);
      $tax_name = $tax_obj->labels->name;
      $terms = get_terms($tax_slug);
      if(count($terms) > 0) {
        echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
        echo "<option value=''>Show All $tax_name</option>";
        foreach ($terms as $term) { 
          echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
        }
        echo "</select>";
      }
    }
  }
}
add_action( 'restrict_manage_posts', 'add_taxonomy_filters' );

// 첨부파일 타입
function get_attachment_type($post_id) {
  $type = get_post_mime_type($post_id);
  switch ($type) {
    case 'image/jpeg':
    case 'image/png':
    case 'image/gif':
      return "image"; break;
    case 'video/mpeg':
    case 'video/mp4': 
    case 'video/quicktime':
    case 'application/zip':
      return "file"; break;
    case 'text/csv':
    case 'text/plain': 
    case 'text/xml':
    case 'application/msword':
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
    case 'application/pdf':
    case 'application/hangul':
      return "document"; break;
    default:
      return "file";
  }
}