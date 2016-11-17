<?php
//comment in parent functions.php jQuery(window).scroll

add_action( 'init', 'create_my_taxonomies', 0 );

function create_my_taxonomies() {
	register_taxonomy( 'technologies', 'post', array( 'hierarchical' => false, 'label' => 'Technologies', 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'projects', 'post', array( 'hierarchical' => false, 'label' => 'Case Studies', 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'areas', 'post', array( 'hierarchical' => false, 'label' => 'Sectors', 'query_var' => true, 'rewrite' => true ) );
	register_taxonomy( 'services', 'post', array( 'hierarchical' => false, 'label' => 'Services', 'query_var' => true, 'rewrite' => true ) );
}

 
add_image_size( 'sectors-thumb', 238, 140, array( 'left', 'top' ) );

require_once('inc/functions.php');
require_once('inc/shortcode.php');

function child_javascript() {

    wp_register_script( 'child_javascript', get_stylesheet_directory_uri().'/js/child_javascript.js', array('jquery') );
    wp_enqueue_script( 'child_javascript', get_stylesheet_directory_uri().'/js/child_javascript.js', array(), '1',$in_footer = true);
}
/*function get_avatar_url($get_avatar){
	preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	return $matches[1];
}*/

add_action('child_add_javascripts','child_javascript');

function generate_category_rewrite_rules($wp_rewrite) {  
  $new_rules = array(  
    "category/(.+)/?" => "index.php?category_name=".$wp_rewrite->preg_index(1),  
    "category/(.+)/page/?([0-9]{1,})/?" => "index.php?category_name=".$wp_rewrite->preg_index(1)."&paged=".$wp_rewrite->preg_index(2),  
    "category/(.+)/(feed|rdf|rss|rss2|atom)/?" => "index.php?category_name=".$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),  
    "category/(.+)/feed/(feed|rdf|rss|rss2|atom)/?" => "index.php?category_name=".$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),
    "tag/(.+)/?" => "index.php?tag=".$wp_rewrite->preg_index(1),  
    "tag/(.+)/page/?([0-9]{1,})/?" => "index.php?tag=".$wp_rewrite->preg_index(1)."&paged=".$wp_rewrite->preg_index(2),  
    "tag/(.+)/(feed|rdf|rss|rss2|atom)/?" => "index.php?tag=".$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),  
    "tag/(.+)/feed/(feed|rdf|rss|rss2|atom)/?" => "index.php?tag=".$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2) ,
     "events/event/(.+)/?" => "index.php?post_type=events&event=".$wp_rewrite->preg_index(1),  
  );  
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules; 
  //add_rewrite_rule('^blogg/([^/]*)/?','index.php?category=$matches[1]','top');
}
add_action('generate_rewrite_rules', 'generate_category_rewrite_rules');

//***Custom Gravatar**/
/*add_filter( 'avatar_defaults', 'anya_child_custom_gravatar' );
function anya_child_custom_gravatar ($avatar_defaults) {
	$myavatar = get_stylesheet_directory_uri() . '/images/default_avatar.jpg';
	$avatar_defaults[$myavatar] = "Dimagi Avatar";
	return $avatar_defaults;
}
[eo_events  ] <a href="%event_url%">%event_title%</a> on %start{jS M Y}{ g:i:a}% [eo_events  ] 

*/

function get_default_avatar() {
    return "/wp-content/themes/anya-child/images/dimagi_icon.png";
}

function get_dimagi_coauthors ($postID) {
    $i = new CoAuthorsIterator($postID);
	$i->iterate();
	do {
		echo $i->current_author->user_login;
	} while( $i->iterate() );
}

function get_author_details($username, $name) {
    // first try by username
    $author_page = get_posts(array(
		'post_type'		 => 'page',
		'posts_per_page' => 1,
		'meta_key'		 => 'username_blog',
		'meta_value'	 => $username,
	));
	if(isset($author_page[0])) {
	    $author_page = $author_page[0];
	} else {
        $author_page = get_page_by_title($name);
	}
	if (isset($author_page)) {
	    $author_url = get_permalink($author_page->ID);
        $author_image = '/'.get_post_meta($author_page->ID, 'staff_photo', true);
	} else {
	    $author_url = get_permalink(176243767);   // team page
        $author_image = get_default_avatar();
	}
	if ($author_image == '/') {
        $author_image = get_default_avatar();
	}
	if ($name == 'Dimagi' || $name == '' || $name == ' ') {
	    $author_url = get_permalink(176243767);
	    $name = 'Dimagi';
	}
	return array(
	    'url'   => $author_url,
	    'image'  => $author_image,
	    'name'   => $name,
	);
}

function get_all_authors($postID) {
    $final_authors = array();
    $legacy_guest_authors = get_post_meta($postID, 'guest_author', true);
    if ($legacy_guest_authors) {
        $author_image = get_default_avatar();
        $authors = array();
        $legacy_authors = explode(',', $legacy_guest_authors);
        foreach ($legacy_authors as $author) {
            $author = trim($author);
            $author_details = get_author_details($author, $author);
            array_push($final_authors, $author_details);
        }
    } else if (function_exists( 'coauthors_posts_links' ))  {
        $i = new CoAuthorsIterator($postID);
        $i->iterate();
        do {
            $username = $i->current_author->user_nicename;
            $name = $i->current_author->first_name.' '.$i->current_author->last_name;
            $author_details = get_author_details($username, $name);
            array_push($final_authors, $author_details);
        } while( $i->iterate() );
    }
    if (!isset($final_authors[0])) {
        $author_url = get_permalink(176243767);
        $author_image = get_default_avatar();
        $author_details = array(
            'url' => $author_url,
            'image' => $author_image,
            'name' => "Dimagi",
        );
        array_push($final_authors, $author_details);
    }
    return $final_authors;
}

function format_by_line($all_authors) {
    $fmt_authors = array();
    foreach ($all_authors as $author) {
        $author_line = '<a href="'.$author['url'].'">'.$author['name'].'</a>';
        array_push($fmt_authors, $author_line);
    }
    return 'by '.implode(', ', $fmt_authors);
}

/*global $wp_rewrite;
$wp_rewrite->flush_rules( false );*/


