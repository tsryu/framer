<?php
/* 통합배너관리 */

add_action( 'init', 'main_banner_create' );

function main_banner_create() {
  register_post_type( 'mainbanner',
    array(
      'labels' => array(
        'name' => '통합배너관리',
        'singular_name' => 'mainbanner',
        'add_new' => '추가하기',
        'add_new_item' => '새 배너 추가',
        'edit' => '편집',
        'edit_item' => '배너 편집',
        'new_item' => '새로운 배너',
        'view' => '보기',
        'view_item' => '배너 보기',
        'search_items' => '배너 검색',
        'not_found' => '배너를 찾을 수 없음',
        'not_found_in_trash' => '휴지통에서 배너를 찾을 수 없음',
        'parent' => '부모 배너',
        'all_items' => '모든 항목'
      ),
      'public' => true,
      'menu_icon' => 'dashicons-admin-tools',
      'menu_position' => 25,
      'supports' => array( 
        'title', 
        'editor', 
        'comments',
        'thumbnail',
        'revisions'
      ),
      'has_archive' => true,
      'rewrite' => true,
      'capabilities' => array(
        'publish_posts' => 'manage_options',
        'edit_posts' => 'manage_options',
        'edit_others_posts' => 'manage_options',
        'delete_posts' => 'manage_options',
        'delete_others_posts' => 'manage_options',
        'read_private_posts' => 'manage_options',
        'edit_post' => 'manage_options',
        'delete_post' => 'manage_options',
        'read_post' => 'manage_options',
      )
    )
  );
}


// taxonomy 추가 - mainbanner_type
add_action( 'init', 'mainbanner_area_taxonomies', 0 ); 

function mainbanner_area_taxonomies() {
  $labels = array(
    'name' => _x( '영역', 'taxonomy general name' ),
    'singular_name' => _x( 'mainbanner_area', 'taxonomy singular name' ),
    'search_items' => __( '영역 검색' ),
    'all_items' => __( '모든 대상' ),
    'parent_item' => __( '상위 대상' ),
    'parent_item_colon' => __( '상위 대상' ),
    'edit_item' => __( '영역 편집' ),
    'update_item' => __( '영역 수정' ),
    'add_new_item' => __( '영역 추가' ),
    'new_item_name' => __( '새로운 영역' ),
    'menu_name' => __( '영역 관리' ),
  );
  register_taxonomy( 
    'mainbanner_area', 
    array( 'mainbanner' ), 
    array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'mainbanner_area' ),  
    )
  );
}


// url 메타
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'meta_banner',
    'title' => '추가정보',
    'fields' => array (
      array (
        'key' => 'meta_banner_url',
        'label' => 'URL',
        'name' => 'banner-url',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'meta_banner_target',
        'label' => '새창에서 열기',
        'name' => 'banner-target',
        'type' => 'true_false',
        'message' => '새창에서 열기',
        'default_value' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'mainbanner',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
