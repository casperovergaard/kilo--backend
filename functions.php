<?php
/**
* Sage includes
*
* The $sage_includes array determines the code library included in your theme.
* Add or remove files to the array as needed. Supports child theme overrides.
*
* Please note that missing files will produce a fatal error.
*
* @link https://github.com/roots/sage/pull/1042
*/
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
* Ajaxify load more posts
*/

function misha_my_load_more_scripts() {

	global $wp_query;

	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');

	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/assets/scripts/myloadmore.js', array('jquery') );

	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => serialize( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );

 	wp_enqueue_script( 'my_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );

function misha_loadmore_ajax_handler(){

	// prepare our arguments for the query
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
  $args['post_type'] = 'work';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

		// run the loop
		while( have_posts() ): the_post();

			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			// get_template_part( 'template-parts/post/content', get_post_format() );
			// for the test purposes comment the line above and uncomment the below one
			the_title();


		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

/**
* Add custom classes for navigation
*/

class Custom_Walker extends Walker_Nav_Menu {
  /**
  * @see Walker::$tree_type
  * @since 3.0.0
  * @var string
  */
  var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

  /**
  * @see Walker::$db_fields
  * @since 3.0.0
  * @todo Decouple this.
  * @var array
  */
  var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

  /**
  * @see Walker::start_lvl()
  * @since 3.0.0
  *
  * @param string $output Passed by reference. Used to append additional content.
  * @param int $depth Depth of page. Used for padding.
  */
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
  }

  /**
  * @see Walker::end_lvl()
  * @since 3.0.0
  *
  * @param string $output Passed by reference. Used to append additional content.
  * @param int $depth Depth of page. Used for padding.
  */
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  /**
  * @see Walker::start_el()
  * @since 3.0.0
  *
  * @param string $output Passed by reference. Used to append additional content.
  * @param object $item Menu item data object.
  * @param int $depth Depth of menu item. Used for padding.
  * @param int $current_page Menu item ID.
  * @param object $args
  */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    // $classes[] = 'list__item menu__list__item ' . $item->ID;
    $classes[] = 'list__item menu__list__item';

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $atts = array();
    // $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
    $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
    $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
    $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
    $atts['class']  = ! empty( $item->class )      ? $item->class      : 'menu__list__item__target';

    $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

    $attributes = '';
    foreach ( $atts as $attr => $value ) {
      if ( ! empty( $value ) ) {
        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $item_output  = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before;
    $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
    $item_output .= $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  /**
  * @see Walker::end_el()
  * @since 3.0.0
  *
  * @param string $output Passed by reference. Used to append additional content.
  * @param object $item Page data object. Not used.
  * @param int $depth Depth of page. Not Used.
  */
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}

/**
* Add ACF Options page
*/
if( function_exists('acf_add_options_page') ) {

  // add parent
  $parent = acf_add_options_page(array(
    'page_title' 	=> 'Options',
    'menu_title' 	=> 'Options',
    'redirect' 		=> false
  ));

  // // add sub page
  // acf_add_options_sub_page(array(
  // 	'page_title' 	=> 'Clients',
  // 	'menu_title' 	=> 'Clients',
  // 	'parent_slug' 	=> $parent['menu_slug'],
  // ));
  //
  // // add sub page
  // acf_add_options_sub_page(array(
  // 	'page_title' 	=> 'Awards',
  // 	'menu_title' 	=> 'Awards',
  // 	'parent_slug' 	=> $parent['menu_slug'],
  // ));
}

// Hide Post from menu. Should be refactored into Sage construct
function my_remove_menu_pages() {
  remove_menu_page('edit.php');
  // remove_menu_page('tools.php');
  // remove_menu_page('users.php');
  // remove_menu_page('edit-comments.php');
}

add_action( 'admin_menu', 'my_remove_menu_pages' );
