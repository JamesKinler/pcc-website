<?php
/*
*Plugin Name: Jcs Event List
*Plugin URI: jcsmarketinginc.com
*Description: Displays one event on the home page and then archives the events to show all upcoming trade show
*Version: 1.0
*Author: James Kinler
*/



//Custom Post Type
add_action('init', 'jk_events');

function jk_events(){
  register_post_type('events',[
    'labels' => [
      'name' => 'Events',
      'singular_name' => 'Event',
      'add_new_item' => 'Add A New Event',
      'edit_item' => 'Edit Event',
      'new_item' => 'New Event',
      'view_item' => 'View Event',
      'search_item' => 'Search Event',
      'not_found' => 'No Event Found',
      'not_found_in_trash' => 'No Event Found In Trash',
      'parent_item_colon' => 'Parent Event',
    ],
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-calendar-alt',
    'publicly_queryable' => true,
    'query_var' => true,
    'supports' => [
      'title', 'editor', 'thumbnail'
    ],
    'taxonomies' => ['event_tags'],
  ]);
}


// Custom Taxonomy For Custom Post

add_action('init', 'event_taxonomy', 0);

function event_taxonomy(){
  $labels = [
    'name' => 'Events Categories',
    'singular_name' => 'Events Category',
    'search_item' => 'Search Events',
    'all_items' => 'All Events',
    'parent_item_colon' => 'Parent Event',
    'update_item' => 'Update Event',
    'add_new_item' => 'Add New Event',
    'new_item_name' => 'New Event Name',
    'menu_name' => 'Events Categories'
  ];
  $args = [
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
  ];
  register_taxonomy('event_taxonomy', 'events', $args);
}

// Custom Tags For The Custom Post Type
add_action('init', 'custom_tag_event_taxonomy', 0);

function custom_tag_event_taxonomy(){
  $labels = [
    'name' => 'Event Tags',
    'singular_name' => 'Event Tag',
    'search_items' => 'Search Event Tags',
    'popular_items' => 'Popular Event Tags',
    'all_items' => 'All Event Tags',
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => 'Edit Event Tags',
    'update_item' => 'Update Event Tags',
    'add_new_item' => 'Add New Event Tag',
    'new_item_name' => 'New Event Tag Name',
    'separate_items_with_commas' => 'Separate Event Tags With Commas',
    'add_or_remove_items' => 'Add or Remove Event Tags',
    'choose_from_most_used' => 'Choose From The Most Used Event Tags',
    'menu_name' => 'Event Tags'
  ];
  $args = [
    'hierachical' => false,
    'labels' => $labels,
    'query_var' => true,
    'rewrite' => ['slug' => 'Event Tags'],
  ];

  register_taxonomy('event_tags',['events'], $args);
}


function event_shortcode($atts){
  $custom_loop_atts = shortcode_atts([
    'number_of_posts' => 1,
    'type' => 'events',
  ],$atts);

  $post_type = $custom_loop_atts['type'];
  $number_of_posts = $custom_loop_atts['number_of_posts'];

  $args = [
    'post_type' => $post_type,
    'post_status' => 'publish',
    'order' => 'date',
    'posts_per_page' => $number_of_posts,
  ];

  $event_shortcode_query = new WP_Query($args);
  ob_start();
  while($event_shortcode_query->have_posts()) : $event_shortcode_query->the_post();
  $post_id = get_the_ID();
  ?>
  <div class="col-lg-3 col-md-6 col-sm-12 ">
    <div class="events">
      <div class="border"></div>
      <h2>Come Check Us Out At Our Next Event</h2>
      <a href="#">Find Out More</a>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12 events_img">
    <?php the_post_thumbnail('full', ['class'=>'img-fluid']);?>
  </div>
  <?php
  endwhile;
  return ob_get_clean();
  wp_reset_postdata();

}

add_shortcode('event', 'event_shortcode');

// Searches for the archive template page for the custom post type in the plugin folder
add_filter('template_include', 'include_template_function', 1);
function include_template_function($template_path){
if(get_post_type()=='events'){
  if(is_archive()){
    if($theme_file = locate_template(['archive-events.php'])){
      $template_path = $theme_file;
    }else{
      $template_path = plugin_dir_path(__FILE__).'./archive-events.php';
      }
    }
  }
return $template_path;
}


// Searches for the signles page for the custom post type template in the plugin folder
add_filter('template_include', 'include_single_template', 1);
function include_single_template($template_path){
  if(get_post_type()=='events'){
    if(is_single()){
      if($theme_file = locate_template(['events-single.php'])){
        $template_path = $theme_file;
      }else{
        $template_path = plugin_dir_path(__FILE__).'./events-single.php';
      }
    }
  }
  return $template_path;
}


?>
