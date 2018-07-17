<?php
/*
*Plugin Name: Sidebar ad
*Plugin URI: jcsmarketinginc.com
*Description: Display a 300X250 ad in the Sidebar
*Version: 1.0
*Author: James Kinler
*/


// the custom post type

add_action('init', 'jk_side_ad');

function jk_side_ad(){
  register_post_type('side_ad',[
    'labels' => [
      'name' => '300X250 Banner Ads',
      'singular_name' => '300X250 Banner',
      'add_new' => 'Add A Banner',
      'add_new_item' => 'Add A New Banner',
      'edit_item' => 'Edit Ad Banner',
      'new_item' => 'Add A New Banner Ad',
      'view_item' => 'View Ad Banner',
      'not_found' => 'No Ad Banner Found',
      'not_found_in_trash' => 'No Ad Banner Found',
      'parent_item_colon' => 'Parent Banner'
    ],
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-images-alt2',
    'publicly_queryable' => true,
    'query_var' => true,
    'supports' => [
      'title', 'editor', 'thumbnail'
    ],
  ]);
}

//300X250 Ad Shortcodem for the ad in the sidebar
function sidebar_ad_shortcode($atts){
  $custom_loop_atts = shortcode_atts([
    'number_of_posts' => 1,
    'type' => 'side_ad',
  ],$atts);

  $post_type = $custom_loop_atts['type'];
  $number_of_posts = $custom_loop_atts['number_of_posts'];

  $args = [
    'post_type' => $post_type,
    'post_status' => 'publish',
    'order' => 'date',
    'posts_per_page' => $number_of_posts,
  ];

  $sidebar_ad_query = new WP_Query($args);
  ob_start();
  while($sidebar_ad_query->have_posts()) : $sidebar_ad_query->the_post();
  $post_id = get_the_ID();
  // the_post_thumbnail('full',['class' => 'img-fluid']);
  the_content();
  endwhile;
  return ob_get_clean();
  wp_reset_postdata();
}

add_shortcode('sidebar_ad', 'sidebar_ad_shortcode');
?>
