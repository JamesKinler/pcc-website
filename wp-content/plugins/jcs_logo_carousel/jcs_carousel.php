<?php
/*
*Plugin Name: Jcs Logo carousel
*Plugin URI: jcsmarketinginc.com
*Description: Displays a number of logos into a carousel
*Version: 1.0
*Author: James Kinler
*/

//Custom Post Type
add_action('init', 'jk_carousel');

function jk_carousel(){
  register_post_type('carousel', [
    'labels' => [
      'name' => 'Sponsors',
      'singular_name' => 'Sponsor',
      'add_new' => 'Add New Sponsor',
      'add_new_item' => 'Add A New Sponsors Logo',
      'edit_item' => 'Edit Sponsors Logo',
      'new_item' => 'New Sponsors Logo',
      'view_item' => 'View Sponsors Logo',
      'not_found' => 'No Sponsors Logo',
      'not_found_in_trash' => 'No Sponsors Logo',
      'parent_item_colon' => 'Parent Logo',
    ],
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-format-image',
    'publicly_queryable' => true,
    'query_var' => true,
    'supports' => [
      'title', 'editor', 'thumbnail'
    ],
    'taxonomies' => [],
  ]);
}

add_action('init', 'carousel_taxonomy', 0);

function carousel_taxonomy(){
  $labels = [
    'name' => 'Logo Sponsors Categories',
    'singular_name' => 'Logo Sponsor Category',
    'search_item' => 'Search Logo Sponsors Categories',
    'all_items' => 'All Logo Sponsors Categories',
    'parent_item_colon' => 'Parent Logo Sponsor Categories',
    'edit_item' => 'Edit Logo Sponsor Categories',
    'update_item' => 'Update Logo Sponsor Categories',
    'add_new_item' => 'Add New Logo Sponsor Categories',
    'new_item_name' => 'New Logo Sponsor Categories',
    'menu_name' => 'Logo Sponsors Categories',
  ];

  $args = [
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
  ];
  register_taxonomy('carousel_taxonomy', 'carousel', $args);
}

//Custom Tags for The Custom Post Type

function custom_tag_carousel_taxonomy(){
  $labels = [
    'name' => 'Sponsor Logo Tags',
    'singular_name' => 'Sponsor Logo Tag',
    'popular_items' => 'Popular Logo Tags',
    'all_items' => 'All Sponsor Logo Tags',
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => 'Edit Sponsor Logo Tags',
    'update_item' => 'Update Sponsor Logo Tags',
    'add_new_item' => 'Add New Sponsor Tags',
    'new_item_name' => 'New Sponsor Tag Name',
    'separate_items_with_commas' => 'Separate Sponsor Logo Tags With Commas',
    'add_or_remove_items' => 'Add or Remove Sponsor Logo Tags',
    'choose_from_most_used' => 'Choose From The Most Used Sponsor Logo Tags',
    'menu_name' => 'Sponsor Log Tags',
  ];

  $args = [
    'hierachical' => false,
    'labels' => $labels,
    'query_var' => true,
    'rewrite' => ['slug' => 'Sponsor Logo Tags'],
  ];

  register_taxonomy('sponsor_logo_tags', ['carousel'], $args);
}

//Sponsor logos shortcode
function sponsor_logo_shortcode($atts){
  $custom_loop_atts = shortcode_atts([
    'number_of_posts' => 10,
    'type' => 'carousel',
  ], $atts);

  $post_type = $custom_loop_atts['type'];
  $number_of_posts = $custom_loop_atts['number_of_posts'];

  $args = [
    'post_type' => $post_type,
    'post_status' => 'publish',
    'order' => 'date',
    'posts_per_page' => $number_of_posts,
  ];

  $sponsor_logo_query = new WP_Query($args);
  ob_start();
  ?>
  <div class="container">
    <div class="carousel slide" id="carouselExample" data-ride="carousel" data-interval="2000">
      <div class="carousel-inner row w-100 mx-auto" role="listbox">
        <?php
          while($sponsor_logo_query->have_posts()) : $sponsor_logo_query->the_post();
          $post_id = get_the_ID();
        ?>
        <div class="carousel-item col-md-3 col-sm-3 align-middle">
          <?php the_post_thumbnail('full', ['class' => 'img-fluid mx-auto d-block']);?>
        </div>
        <?php
          endwhile;
          return ob_get_clean();
        ?>
      </div>
    </div>
  </div>
  <?php

wp_reset_postdata();
}

add_shortcode('carousel', 'sponsor_logo_shortcode');


function myplugin_script(){
  wp_register_script('carsouel_js',plugin_dir_url(__FILE__).'./js/carousel_js.js',array('jquery'),'',true);
  wp_enqueue_script('carsouel_js');
}

add_action('wp_enqueue_scripts', 'myplugin_script');

?>
