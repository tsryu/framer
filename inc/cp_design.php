<?php
/*

Design

*/

add_action( 'init', 'design_create' );

function design_create() {
  register_post_type( 'design',
    array(
      'labels' => array(
      'name' => 'design',
      'singular_name' => 'design',
      'add_new' => '추가하기',
      'add_new_item' => '아이템 추가',
      'edit' => '편집',
      'edit_item' => '아이템 편집',
      'new_item' => '새로운 design',
      'view' => '보기',
      'view_item' => 'design 보기',
      'search_items' => 'design 검색',
      'not_found' => '검색결과 없음',
      'not_found_in_trash' =>
      '(휴지통)검색결과 없음',
      'parent' => '부모 design'
      ),
      'public' => true,
      'menu_position' => 6,
      'supports' =>
      array( 
        'title', 
        'editor', 
        'excerpt',
        // 'comments',
        'thumbnail',  
        ),
      'has_archive' => true,
      'rewrite' => true,
    )
  );
}

//rest api 등록
add_action( 'init', 'add_design_to_json_api', 30 );
function add_design_to_json_api(){

    global $wp_post_types;
    $wp_post_types['design']->show_in_rest = true;
    $wp_post_types['design']->rest_base = 'design';
    $wp_post_types['design']->rest_controller_class = 'WP_REST_Posts_Controller';
}

// taxonomy 추가 - design_type

// add_action( 'init', 'design_type_taxonomies', 0 ); 

// function design_type_taxonomies() {
//     $labels = array(
//         'name' => _x( '부문 관리', 'taxonomy general name' ),
//         'singular_name' => _x( 'design_type', 'taxonomy singular name' ),
//         'search_items' => __( '부문 검색' ),
//         'all_items' => __( '모든 part' ),
//         'parent_item' => __( '상위 part' ),
//         'parent_item_colon' => __( '상위 part' ),
//         'edit_item' => __( '부문 편집' ),
//         'update_item' => __( '부문 수정' ),
//         'add_new_item' => __( '부문 추가' ),
//         'new_item_name' => __( '새로운 부문' ),
//         'menu_name' => __( '부문 관리' ),
//     );
//     register_taxonomy( 
//       'design_type', 
//       array( 'design' ), 
//       array(
//           'hierarchical' => true,
//           'labels' => $labels,
//           'show_ui' => true,
//           'show_admin_column' => true,
//           'query_var' => true,
//           'rewrite' => array( 'slug' => 'design_type' ), 
//       ) 
//     );
// }


?>