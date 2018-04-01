<?php
// THE FUNCTIONS.PHP FILE
// (C) CATS 2018

if ( ! function_exists( 'main_setup' ) ) :
function main_setup() {
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'main' ),
) );

add_theme_support( 'html5', array(
		'search-form',
		'gallery',
		'caption'
) );
}
endif;
add_action( 'after_setup_theme', 'main_setup' );
function main_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'main' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'main' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'main_widgets_init' );

// change 'posts' to 'blog posts' in dashboard for clarity
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog Posts';
    $submenu['edit.php'][5][0] = 'Blog Posts';
    $submenu['edit.php'][10][0] = 'Add Blog Post';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

// remove backend menu page links that faculty members shouldnt mess with
function custom_menu_page_removing() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('tools.php');
    remove_menu_page('users.php');
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

// PUBLICATION POST TYPE
function publications_post_type() {
// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Publication', 'Post Type General Name'),
		'singular_name'       => _x( 'Item', 'Post Type Singular Name'),
		'menu_name'           => __( 'Publications'),
		'parent_item_colon'   => __( 'Parent Publication'),
		'all_items'           => __( 'All Publications'),
		'view_item'           => __( 'View Publication'),
		'add_new_item'        => __( 'Add New Publication'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Publication'),
		'update_item'         => __( 'Update Publication'),
		'search_items'        => __( 'Search Publications'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'publications'),
		'description'         => __( 'Faculty member publications'),
		'menu_icon'	=> 'dashicons-book-alt',
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'publications', $args );
}
 add_action( 'init', 'publications_post_type', 0 );

add_action( 'init', 'create_pub_taxonomies', 0 );
function create_pub_taxonomies() {
	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Publication Tags', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Tags', 'textdomain' ),
		'all_items'                  => __( 'All Tags', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag', 'textdomain' ),
		'update_item'                => __( 'Update Tag', 'textdomain' ),
		'add_new_item'               => __( 'Add New Tag', 'textdomain' ),
		'new_item_name'              => __( 'New Tag', 'textdomain' ),
		'not_found'                  => __( 'No tags found.', 'textdomain' ),
		'menu_name'                  => __( 'Tags', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'tags' ),
	);

	register_taxonomy( 'pubtags', 'publications', $args );
}
// END PUBLICATIONS POST TYPE



// ACADEMIC POSITIONS POST TYPE
function positions_post_type() {
// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Academic Positions', 'Post Type General Name'),
		'singular_name'       => _x( 'Position', 'Post Type Singular Name'),
		'menu_name'           => __( 'Acad. Positions'),
		'parent_item_colon'   => __( 'Parent Position'),
		'all_items'           => __( 'All Positions'),
		'view_item'           => __( 'View Positions'),
		'add_new_item'        => __( 'Add New Position'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Position'),
		'update_item'         => __( 'Update Position'),
		'search_items'        => __( 'Search Positions'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'positions'),
		'description'         => __( 'Faculty academic positions'),
		'menu_icon'	=> 'dashicons-businessman',
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'revisions'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'positions', $args );
}
 add_action( 'init', 'positions_post_type', 0 );
// END POSITIONS POST TYPE


// DEGREES POST TYPE
function degrees_post_type() {
// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Degrees', 'Post Type General Name'),
		'singular_name'       => _x( 'Item', 'Post Type Singular Name'),
		'menu_name'           => __( 'Degrees'),
		'parent_item_colon'   => __( 'Parent Degree'),
		'all_items'           => __( 'All Degrees'),
		'view_item'           => __( 'View Degrees'),
		'add_new_item'        => __( 'Add New Degree'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Degree'),
		'update_item'         => __( 'Update Degree'),
		'search_items'        => __( 'Search Degrees'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'degrees'),
		'description'         => __( 'Faculty degrees'),
		'menu_icon'	=> 'dashicons-format-aside',
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'revisions'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'degrees', $args );
}
 add_action( 'init', 'degrees_post_type', 0 );
// END DEGREES POST TYPE


// AWARDS POST TYPE
function awards_post_type() {
// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Awards', 'Post Type General Name'),
		'singular_name'       => _x( 'Award', 'Post Type Singular Name'),
		'menu_name'           => __( 'Awards'),
		'parent_item_colon'   => __( 'Parent Award'),
		'all_items'           => __( 'All Awards'),
		'view_item'           => __( 'View Awards'),
		'add_new_item'        => __( 'Add New Award'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Award'),
		'update_item'         => __( 'Update Award'),
		'search_items'        => __( 'Search Awards'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash'),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'awards'),
		'description'         => __( 'Faculty awards and honors'),
		'menu_icon'	=> 'dashicons-awards',
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'revisions'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'awards', $args );
}
 add_action( 'init', 'awards_post_type', 0 );
// END DEGREES POST TYPE
