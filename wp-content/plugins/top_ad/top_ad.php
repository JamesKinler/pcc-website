<?php
/*
*Plugin Name:  Topbar ad
*Plugin URI: jcsmarketinginc.com
*Description: Display a 728X90 Banner
*Version: 1.0
*Author: James Kinler
*/


// the custom post type

add_action('init', 'jk_top_ad');

function jk_top_ad(){
  register_post_type('top_ad',[
    'labels' => [
      'name' => '728X90 Banner Ads',
      'singular_name' => '728X90 Banner Ad',
      'add_new' => 'Add A New Banner',
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
    'menu_icon' => 'dashicons-images-alt',
    'publicly_queryable' => true,
    'query_var' => true,
    'supports' => [
      'title', 'editor', 'thumbnail'
    ],
  ]);
}


// 728X90 ad shortcode for the top of the website ad banner
function top_ad_shortcode($atts){
  $custom_loop_atts = shortcode_atts([
    'number_of_posts' => 1,
    'type' => 'top_ad',
  ],$atts);

  $post_type = $custom_loop_atts['type'];
  $number_of_posts = $custom_loop_atts['number_of_posts'];

  $args = [
    'post_type' => $post_type,
    'post_status' => 'publish',
    'order' => 'date',
    'posts_per_page' => $number_of_posts,
  ];

  $top_ad_query = new WP_Query($args);
  ob_start();
  while($top_ad_query->have_posts()) : $top_ad_query->the_post();
  $post_id = get_the_ID();
  // the_post_thumbnail('full', ['class' => 'img-fluid']);
  the_content();
  endwhile;
  return ob_get_clean();
  wp_reset_postdata();
}

add_shortcode('top_ad', 'top_ad_shortcode');
?>
