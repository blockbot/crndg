<?php

// register nav menu
function register_ic_menus() {
  register_nav_menus(
    array(
   		'left-menu' => __( 'Left Menu' ),
   		'right-menu' => __( 'Right Menu' )
    )
  );
}
add_action( 'init', 'register_ic_menus' );

add_theme_support( 'title-tag' );

// enable thumbnails
add_theme_support( 'post-thumbnails' ); 

// register work custom post type
function work_register() {
 
	$labels = array(
		'name' => _x('Work', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'Project'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title','editor','custom-fields','page-attributes', 'author', 'excerpt','thumbnail'),
		'taxonomies' => array('category', 'post_tag')
	  );
 
	register_post_type( 'work' , $args );
}
add_action('init', 'work_register');

/**
 *
 * @get text between tags
 *
 * @param string $tag The tag name
 *
 * @param string $html The XML or XHTML string
 *
 * @param int $strict Whether to use strict mode
 *
 * @return array
 *
 */
function getTextBetweenTags($tag, $html, $strict=0)
{
    /*** a new dom object ***/
    $dom = new domDocument;

    /*** load the html into the object ***/
    if($strict==1)
    {
        $dom->loadXML($html);
    }
    else
    {
        $dom->loadHTML($html);
    }

    /*** discard white space ***/
    $dom->preserveWhiteSpace = false;

    /*** the tag by its tag name ***/
    $content = $dom->getElementsByTagname($tag);

    /*** the array to return ***/
    $out = array();
    foreach ($content as $item)
    {
        /*** add node value to the out array ***/
        $out[] = $item->nodeValue;
    }
    /*** return the results ***/
    return $out;
}

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
	$root_id = 0;
	
	// find the current menu item
	foreach ( $sorted_menu_items as $menu_item ) {
	  if ( $menu_item->current ) {
		// set the root id based on whether the current menu item has a parent or not
		$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
		break;
	  }
	}
	
	// find the top level parent
	if ( ! isset( $args->direct_parent ) ) {
	  $prev_root_id = $root_id;
	  while ( $prev_root_id != 0 ) {
		foreach ( $sorted_menu_items as $menu_item ) {
		  if ( $menu_item->ID == $prev_root_id ) {
			$prev_root_id = $menu_item->menu_item_parent;
			// don't set the root_id to 0 if we've reached the top of the menu
			if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
			break;
		  } 
		}
	  }
	}
	$menu_item_parents = array();
	foreach ( $sorted_menu_items as $key => $item ) {
	  // init menu_item_parents
	  if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
	  if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
		// part of sub-tree: keep!
		$menu_item_parents[] = $item->ID;
	  } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
		// not part of sub-tree: away with it!
		unset( $sorted_menu_items[$key] );
	  }
	}
	
	return $sorted_menu_items;
  } else {
	return $sorted_menu_items;
  }
}

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// Search support
$liveSearch = new searchBuilder();
class searchBuilder {
  const LANG = "liveSearch_textdomain";
  
  public $plugins_url;

  public function __construct(){
	add_action("wp_ajax_search_posts", array($this, "search_posts"));
	add_action("wp_ajax_nopriv_search_posts", array($this, "search_posts"));
  }

  public function search_posts(){
	$query = $_POST["query"];
	$args = array( 'post_status' => 'publish', 's' => $query );
	$search = new WP_Query($args);

	ob_start();

	if($search->have_posts()): 
	  while($search->have_posts()): $search->the_post();
		get_template_part("template-parts/post", "loop"); 
	  endwhile; 
	endif;
	
	$search_results = ob_get_clean();

	echo $search_results;
	die();  

  }
}

function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

add_filter( 'clean_url', function( $url ){
 
	if(is_admin()){
	
		if ( FALSE === strpos( $url, '.js' ) )
	    { // not our file
	        return $url;
	    }
	    // Must be a ', not "!
	    return "$url'";

	} else {

		if ( FALSE === strpos( $url, '.js' ) )
	    { // not our file
	        return $url;
	    }
	    // Must be a ', not "!
	    return "$url' defer='defer";

	}
    
}, 11, 1 );

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

add_action('wp_ajax_get_project', 'get_project');
add_action('wp_ajax_nopriv_get_project','get_project');

function get_project(){

	$project_id = $_GET['id'];
	$post_info = get_post($project_id);

	if (isset($_GET['id'])){

		$project_short_description = get_field("project_short_description", $project_id);
		$project_details = get_field("project_details", $project_id);
		$project_link = get_field("project_link", $project_id);

		$array = [
			"projectTitle" => $post_info->post_title,
			"projectShortDescription" => $project_short_description,
			"projectDescription" => $post_info->post_content,			
			"projectDetails" => $project_details,
			"projectUrl" => $project_link
		];
	
	}

	echo json_encode($array);
	die;

}

?>