<?php
/**
 * This file contains all the testimonials functionality.
 *
 */

/**
 * ADD THE ACTIONS
 */
add_action('init', 'designare_register_testimonials_post_type');  //functions/testimonials.php


/**
 * Registers the portfolio custom type.
 */
function designare_register_testimonials_post_type() {

	register_taxonomy("testimonials_category",
	array(DESIGNARE_TESTIMONIALS_POST_TYPE),
	array(	"hierarchical" => true,
			"label" => "Categories", 
			"singular_label" => "Categories", 
			"rewrite" => true,
			"query_var" => true
	));

	//the labels that will be used for the portfolio items
	$labels = array(
		    'name' => _x('Testimonials', 'testimonials name','anya'),
		    'singular_name' => _x('Testimonials Item', 'testimonials type singular name','anya'),
		    'add_new' => __('Add New','anya'),
		    'add_new_item' => __('Add New Item','anya'),
		    'edit_item' => __('Edit Item','anya'),
		    'new_item' => __('New Testimonials Item','anya'),
		    'view_item' => __('View Item','anya'),
		    'search_items' => __('Search Testimonials Items','anya'),
		    'not_found' =>  __('No testimonials items found','anya'),
		    'not_found_in_trash' => __('No testimonials items found in Trash','anya'), 
		    'parent_item_colon' => ''
		    );

		    //register the custom post type
		    register_post_type( DESIGNARE_TESTIMONIALS_POST_TYPE,
		    array( 'labels' => $labels,
	         'public' => true,  
	         'show_ui' => true,
	         'exclude_from_search' => true,
	         'show_in_nav_menus' => false,
	         'menu_icon' => get_template_directory_uri() . '/img/designare_icons/testicon.png',  
	         'capability_type' => 'post',  
	         'hierarchical' => false,  
			 		 'rewrite' => array('slug'=>'testimonials'),
			 		 'taxonomies' => array('testimonials_category', 'post_tag'),
	         'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes') ) );


}