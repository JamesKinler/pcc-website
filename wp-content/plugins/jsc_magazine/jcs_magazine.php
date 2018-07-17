<?php
/*
*Plugin Name: Jcs Magazine List
*Plugin URI: jcsmarketinginc.com
*Description: Displays and Archives All The Magazines To Show And Download
*Version: 1.0
*Author: James Kinler
*/


// Custom Post Type
add_action('init', 'jk_magazine');

function jk_magazine(){
  register_post_type('magazine',[
    'labels'=>[
      'name' => 'Magazines',
      'singular_name' => 'Magazine',
      'add_new_item' => 'Add A New Magazine',
      'edit_item' => 'Edit Magazine',
      'new_item' => 'New Magazine',
      'view_item' => 'View Magazine',
      'search_item' => 'Search Magazine',
      'not_found' => 'No Magazine Found',
      'not_found_in_trash' => 'No Magazine Found In The Trash',
      'parent_item_colon' => 'Parent Magazine',
    ],
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-book-alt',
    'publicly_queryable' => true,
    'query_var' => true,
    'supports' => [
      'title', 'editor', 'thumbnail'
    ],
    'taxonomies' => ['magazine_taxonomy','magazine_tags'],
  ]);
}


// Custom Taxonomy For Custom Post
add_action('init', 'magazine_taxonomy', 0);

function magazine_taxonomy(){
  $labels = [
    'name' => 'Magazine Categories',
    'singular_name' => 'Magazine Category',
    'search_item' => 'Search Magazine Categories',
    'all_items' => 'All Magazine Categories',
    'parent_item_colon' => 'Parent Magazine Categories',
    'edit_item' => 'Edit Magazine Category',
    'update_item' => 'Update Magazine Category',
    'add_new_item' => 'Add New Magazine Category',
    'new_item_name' => 'New Magazine Name Category',
    'menu_name' => 'Magazines Categories'
  ];

  $args = [
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
  ];
  register_taxonomy('magazine_taxonomy','magazine', $args);
}

// Custom Tags For The Custom Post Type
add_action('init', 'custom_tag_magazine_taxonomy',0);

function custom_tag_magazine_taxonomy(){
  $labels = [
    'name' => 'Magazine Tags',
    'singular_name' => 'Magazine Tag',
    'search_items' => 'Search Magazine Tags',
    'popular_items' => 'Popular Magazine Tags',
    'all_items' => 'All Magazine Tags',
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => 'Edit Magazine Tags',
    'update_item' => 'Update Magazine Tags',
    'add_new_item' => 'Add New Magazine Tag',
    'new_item_name' => 'New Magazine Tag Name',
    'separate_items_with_commas' => 'Separate Magazine Tags With Commas',
    'add_or_remove_items' => 'Add or Remove Magazine Tags',
    'choose_from_most_used' => 'Choose from the most used Magazine Tags',
    'menu_name' => 'Magazine Tags',
  ];

  $args = [
    'hierachical' => false,
    'labels' => $labels,
    'query_var' => true,
    'rewrite' => ['slug'=> 'Magazine Tags'],
  ];

  register_taxonomy('magazine_tags',['magazine'], $args);
}

// Magazine Shortcode

function magazine_shortcode($atts){

  $custom_loop_atts = shortcode_atts([
    'number_of_posts' => 1,
    'type' => 'magazine',
  ],$atts);

  $post_type = $custom_loop_atts['type'];
  $number_of_posts = $custom_loop_atts['number_of_posts'];

  $args =[
    'post_type' => $post_type,
    'post_status' => 'publish',
    'order' => 'date',
    'posts_per_page' => $number_of_posts,
  ];

  $shortcode_query = new WP_Query($args);
  ob_start();
  while($shortcode_query->have_posts()) : $shortcode_query->the_post();
  $post_id = get_the_ID();
  ?>
  <div class="col-lg-3 col-md-6 col-sm-12 magazine_download">
    <h2>Get the <span>Magazine</span></h2>
    <p>Click on the magazine to view the latest Progressive Crop Consultant or click the button to view past issues of Progressive Crop Consultant</p>
    <a href="/magazine/">Past Issues</a>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12 magazine_img">
    <div><?php the_content(); ?></div>

  </div>
  <?php
  endwhile;
  return ob_get_clean();
  wp_reset_postdata();

}
add_shortcode('magazine', 'magazine_shortcode');


// Searches for the archive template page for the custom post type in the plugin folder
add_filter('template_include', 'include_template_magazine_function', 1);
function include_template_magazine_function($template_path){
  if(get_post_type()=='magazine'){
    if(is_archive()){
      if($theme_file = locate_template(['archive-jcs_magazine.php'])){
        $template_path = $theme_file;
      }else{
        $template_path = plugin_dir_path(__FILE__).'/archive-jcs_magazine.php';
      }
    }
  }
  return $template_path;
}

// Searches for the archive template pages for the custom post type in the plugin folder
add_filter('template_include', 'include_template_single_magazine', 1);
function include_template_single_magazine($template_path){
  if(get_post_type()=='magazine'){
    if(is_single()){
      if($theme_file = locate_template(['magazine-single.php'])){
        $template_path = $theme_file;
      }else{
        $template_path = plugin_dir_path(__FILE__).'./magazine-signle.php';
      }
    }
  }
  return $template_path;
}


//changes the number of how many magazines are showen on the archive page
function wpsites_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 16 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );



//paganation numbers for archive page
function jk_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    // Stop execution if there's only 1 page
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    // Add current page to the array
    if ( $paged >= 1 )
        $links[] = $paged;

    // Add the pages around the current page to the array
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    // Previous Post Link
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    // Link to first page, plus ellipses if necessary
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    // Link to current page, plus 2 pages in either direction if necessary
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    // Link to last page, plus ellipses if necessary
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    // Next Post Link
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}


?>
