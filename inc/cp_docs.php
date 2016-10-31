<?php
/*

Docs

*/

add_action( 'init', 'docs_create' );

function docs_create() {
  register_post_type( 'docs',
    array(
      'labels' => array(
      'name' => 'Docs',
      'singular_name' => 'docs',
      'add_new' => '추가하기',
      'add_new_item' => '아이템 추가',
      'edit' => '편집',
      'edit_item' => '아이템 편집',
      'new_item' => '새로운 Docs',
      'view' => '보기',
      'view_item' => 'Docs 보기',
      'search_items' => 'Docs 검색',
      'not_found' => '검색결과 없음',
      'not_found_in_trash' =>
      '(휴지통)검색결과 없음',
      'parent' => '부모 Docs'
      ),
      'public' => true,
      'menu_position' => 7,
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


// taxonomy 추가 - docs_type

// add_action( 'init', 'docs_type_taxonomies', 0 ); 

// function docs_type_taxonomies() {
//     $labels = array(
//         'name' => _x( 'Docs 관리', 'taxonomy general name' ),
//         'singular_name' => _x( 'docs_type', 'taxonomy singular name' ),
//         'search_items' => __( 'Docs 검색' ),
//         'all_items' => __( '모든 part' ),
//         'parent_item' => __( '상위 part' ),
//         'parent_item_colon' => __( '상위 part' ),
//         'edit_item' => __( 'Docs 편집' ),
//         'update_item' => __( 'Docs 수정' ),
//         'add_new_item' => __( 'Docs 추가' ),
//         'new_item_name' => __( '새로운 Docs' ),
//         'menu_name' => __( 'Docs 관리' ),
//     );
//     register_taxonomy( 
//       'docs_type', 
//       array( 'docs' ), 
//       array(
//           'hierarchical' => true,
//           'labels' => $labels,
//           'show_ui' => true,
//           'show_admin_column' => true,
//           'query_var' => true,
//           'rewrite' => array( 'slug' => 'docs_type' ), 
//       ) 
//     );
// }


?>