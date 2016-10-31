<?php
/*

Docs

*/

add_action( 'init', 'get_started_create' );

function get_started_create() {
  register_post_type( 'get_started',
    array(
      'labels' => array(
      'name' => 'Get started',
      'singular_name' => 'get_started',
      'add_new' => '추가하기',
      'add_new_item' => '아이템 추가',
      'edit' => '편집',
      'edit_item' => '아이템 편집',
      'new_item' => '새로운 Get started',
      'view' => '보기',
      'view_item' => 'Get started 보기',
      'search_items' => 'Get started 검색',
      'not_found' => '검색결과 없음',
      'not_found_in_trash' =>
      '(휴지통)검색결과 없음',
      'parent' => '부모 Get started'
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


// taxonomy 추가 - get_started_type

// add_action( 'init', 'get_started_type_taxonomies', 0 ); 

// function get_started_type_taxonomies() {
//     $labels = array(
//         'name' => _x( '부문 관리', 'taxonomy general name' ),
//         'singular_name' => _x( 'get_started_type', 'taxonomy singular name' ),
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
//       'get_started_type', 
//       array( 'get_started' ), 
//       array(
//           'hierarchical' => true,
//           'labels' => $labels,
//           'show_ui' => true,
//           'show_admin_column' => true,
//           'query_var' => true,
//           'rewrite' => array( 'slug' => 'get_started_type' ), 
//       ) 
//     );
// }


?>