<?php

//this enqueues my extra styles and my fonts
function jk_styles(){
	wp_enqueue_style('materialize_css',get_stylesheet_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_style('social media fonts','https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous"');
	wp_enqueue_style('fonts', "http://fonts.googleapis.com/icon?family=Material+Icons");


}
// this adds to wordpress
add_action('wp_enqueue_scripts','jk_styles');



// this regiesters and enqueues the javascript
function jk_scripts(){
	wp_register_script('materialize-js',get_stylesheet_directory_uri().'/js/bootstrap.min.js',array('jquery'),true);
	wp_enqueue_script('materialize-js');
	wp_register_script('myjs',get_stylesheet_directory_uri().'/js/myjs.js',array('jquery'),true);
	wp_enqueue_script('myjs');
}
// this adds to wordpress
add_action('wp_enqueue_scripts', 'jk_scripts');

//excerpt length
function jk_excerpt_length($length){
	return 25;
}
add_filter('excerpt_length', 'jk_excerpt_length', 999);


function jk_excerpt_more($more){
		return '....';
}
add_filter('excerpt_more', 'jk_excerpt_more');

// this is registers the nav bar to the menus section
register_nav_menus([
	'primary' =>__('primary menu', 'pcc_child'),
	'mobile' =>__('mobile nav', 'pcc_child'),
	'footer' => __('footer nav', 'pcc_child'),

]);



require_once('class-wp-bootstrap-navwalker.php');




?>
