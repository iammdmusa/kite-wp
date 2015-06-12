<?php
/**
 * kite functions and definitions
 *
 * @package kite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'kite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on kite, use a find and replace
	 * to change 'kite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'kite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'blog_default', 270, 270,true);
    add_image_size( 'blog_style2_1', 680, 400,true);
    add_image_size( 'blog_style2_2', 340, 200,true);
    add_image_size( 'blog_style2_3', 170, 100,true);
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // kite_setup
add_action( 'after_setup_theme', 'kite_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function kite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'kite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
    register_sidebar( array(
        'name'          => __( 'Footer Newsletter & Misc', 'kite' ),
        'id'            => 'sidebar-2',
        'description'   => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s footer-widgets">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'kite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kite_scripts() {
	wp_enqueue_style( 'kite-style', get_stylesheet_uri() );

    /*Kites Common Stylesheet*/
    wp_enqueue_style( 'kite-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'kite-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'kite-animate', get_template_directory_uri() . '//css/animate.css' );
    if ( is_page_template( 'kite-light.php' ) ) {
        /*light-page*/
        wp_enqueue_style( 'kite-theme', get_template_directory_uri() . '/css/theme.css' );
    }
    if ( is_page_template( 'kite.php' ) ) {
        /*Dark-page*/
        wp_enqueue_style( 'kite-theme-dark', get_template_directory_uri() . '/css/theme-dark.css' );
    }
    if ( is_page_template( '404.php' ) ) {
        /*404-page*/
        wp_enqueue_style( 'kite-theme-404', get_template_directory_uri() . '/css/theme-404.css' );
    }
    if ( is_page_template( 'coomingup.php' ) ) {
        /* coming up-page*/
        wp_enqueue_style( 'kite-theme-coming', get_template_directory_uri() . '/css/theme-comingup.css' );
    }
    wp_enqueue_style( 'kite', get_template_directory_uri() . '/css/kite.css' );
    /*JS Part*/
	wp_enqueue_script( 'kite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    wp_enqueue_script( 'kite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    /*Kites JS*/
    wp_enqueue_script( 'kite-modernizr', get_template_directory_uri() . '/js/modernizr.custom.12691.js', array(), '12691', true );
    wp_enqueue_script( 'kite-jquery', get_template_directory_uri() . '/js/jquery-1.11.0.js', array(), '1110', false );

    wp_enqueue_script( 'kite-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), '', false );
    wp_enqueue_script( 'kite-bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', false );
    wp_enqueue_script( 'kite-jquery.easing.min', get_template_directory_uri() . '/js/jquery.easing.min.js', array(), '', false );
    wp_enqueue_script( 'kite-jquery.mixitup.min', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array(), '', false );
    wp_enqueue_script( 'kite-wow.js', get_template_directory_uri() . '/js/dist/wow.js', array(), '', false );
    wp_enqueue_script( 'kite-countUp', get_template_directory_uri() . '/js/countUp.min.js', array(), '', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kite_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//function kite_custom_nav(){
//    global $kite_muri;
//    $get_kite_nav = array();
//    if($kite_muri['slider_switch-on']==true){
//        echo $get_kite_nav = "slider";
//    }
//    return ($get_kite_nav);
//}

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/functions/kite-admin.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/functions/kite-admin.php' );
}
function kite_featured_icon_metaboxes()
{
    $prefix = "_kite_";
    $meta_boxes[] = array(
        'id' => 'Slider',
        'title' => __('Slider Details ',"kite"),
        'pages' => array('Slider'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Slider Image',"kite"),
                'id' => $prefix . 'slider_media',
                'type' => 'file'
            ),
            array(
                'name' => __('Slider Sub-Title',"kite"),
                'id' => $prefix . 'slider_sub_title',
                'type' => 'text'
            ),
            array(
                'name' => __('Slider Button Text',"kite"),
                'id' => $prefix . 'slider_btn_title',
                'type' => 'text'
            ),
            array(
                'name' => __('Slider Button URL',"kite"),
                'id' => $prefix . 'slider_btn_url',
                'type' => 'text'
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'Portfolio',
        'title' => __('Portfolio Details ',"kite"),
        'pages' => array('Portfolio'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Portfolio Image',"kite"),
                'id' => $prefix . 'portfolio_img',
                'type' => 'file'
            ),
            array(
                'name' => __('Portfolio Description',"kite"),
                'id' => $prefix . 'portfolio_description',
                'type' => 'wysiwyg',
                'options' => array(),
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'Team',
        'title' => __('Team Details ',"kite"),
        'pages' => array('team'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Profile Image',"kite"),
                'id' => $prefix . 'team_img',
                'type' => 'file'
            ),
            array(
                'name' => __('Bio',"kite"),
                'id' => $prefix . 'team_bio',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Role & Position',"kite"),
                'id' => $prefix . 'rl_position',
                'type' => 'text'
            ),
            array(
                'name' => __('Twitter Profile',"kite"),
                'id' => $prefix . 'team_social_tw',
                'type' => 'text'
            ),
            array(
                'name' => __('Facebook Profile',"kite"),
                'id' => $prefix . 'team_social_fb',
                'type' => 'text'
            ),
            array(
                'name' => __('Linkedin Profile',"kite"),
                'id' => $prefix . 'team_social_linkedin',
                'type' => 'text'
            ),
        )
    );
    $meta_boxes[] = array(
        'id' => 'Testimonial',
        'title' => __('Testimonial Details ',"kite"),
        'pages' => array('testimonial'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Client Designation',"kite"),
                'id' => $prefix . 'client_designation',
                'type' => 'text'
            ),
            array(
                'name' => __('Client Bio',"kite"),
                'id' => $prefix . 'client_bio',
                'type' => 'textarea'
            ),
            array(
                'name' => __('Picture',"kite"),
                'id' => $prefix . 'client_pic',
                'type' => 'file'
            ),
            array(
                'name' => __('Brand Logo',"kite"),
                'id' => $prefix . 'client_logo',
                'type' => 'file'
            ),
        )
    );

    return $meta_boxes;
}

add_filter('cmb_meta_boxes', 'kite_featured_icon_metaboxes');

// Initialize the metabox class
add_action('init', 'kite_initialize_cmb_meta_boxes', 9999);
function kite_initialize_cmb_meta_boxes()
{
    if (!class_exists('cmb_Meta_Box')) {
        require_once('libs/cmb/init.php');
    }
}

function kite_custom_posts()
{

    $labels1 = array(
        'name' => _x('Slider', 'Post Type General Name', 'kite'),
        'singular_name' => _x('Slider', 'Post Type Singular Name', 'kite'),
        'menu_name' => __('Sliders', 'kite'),
        'parent_item_colon' => __('Parent Slider:', 'kite'),
        'all_items' => __('All Slider', 'kite'),
        'view_item' => __('View Slider', 'kite'),
        'add_new_item' => __('Add New Slider', 'kite'),
        'add_new' => __('New Slider', 'kite'),
        'edit_item' => __('Edit Slider', 'kite'),
        'update_item' => __('Update Slider', 'kite'),
        'search_items' => __('Search Slider', 'kite'),
        'not_found' => __('No Slider found', 'kite'),
        'not_found_in_trash' => __('No Slider found in Trash', 'kite'),
    );
    $args1 = array(
        'label' => __('Slider', 'kite'),
        'description' => __('Slider', 'kite'),
        'labels' => $labels1,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/img/icons/experience.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('slider', $args1);

    $labels2 = array(
        'name' => _x('Portfolio ', 'Post Type General Name', 'kite'),
        'singular_name' => _x('Portfolio', 'Post Type Singular Name', 'kite'),
        'menu_name' => __('Portfolios', 'kite'),
        'parent_item_colon' => __('Parent Portfolio:', 'kite'),
        'all_items' => __('All Portfolios', 'kite'),
        'view_item' => __('View Portfolio', 'kite'),
        'add_new_item' => __('Add New Portfolio', 'kite'),
        'add_new' => __('New Portfolio', 'kite'),
        'edit_item' => __('Edit Portfolio', 'kite'),
        'update_item' => __('Update Portfolio', 'kite'),
        'search_items' => __('Search Portfolios', 'kite'),
        'not_found' => __('No Portfolio found', 'kite'),
        'not_found_in_trash' => __('No Portfolio found in Trash', 'kite'),
    );
    $args2 = array(
        'label' => __('Portfolio', 'kite'),
        'description' => __('Portfolio', 'kite'),
        'labels' => $labels2,
        'supports' => array('title'),
//        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/img/icons/education.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('Portfolio', $args2);

    $labels3 = array(
        'name' => _x('Testimonials', 'Post Type General Name', 'kite'),
        'singular_name' => _x('Testimonial', 'Post Type Singular Name', 'kite'),
        'menu_name' => __('Testimonials', 'kite'),
        'parent_item_colon' => __('Parent Testimonial:', 'kite'),
        'all_items' => __('All Testimonials', 'kite'),
        'view_item' => __('View Testimonial', 'kite'),
        'add_new_item' => __('Add New Testimonial(Client Name)', 'kite'),
        'add_new' => __('New Testimonial', 'kite'),
        'edit_item' => __('Edit Testimonial', 'kite'),
        'update_item' => __('Update Testimonial', 'kite'),
        'search_items' => __('Search Testimonials', 'kite'),
        'not_found' => __('No testimonial found', 'kite'),
        'not_found_in_trash' => __('No testimonials found in Trash', 'kite'),
    );
    $args3 = array(
        'label' => __('Testimonial', 'kite'),
        'description' => __('Testimonial', 'kite'),
        'labels' => $labels3,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/img/icons/testimonial.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('testimonial', $args3);

    $labels4 = array(
        'name' => _x('Team', 'Post Type General Name', 'kite'),
        'singular_name' => _x('Team', 'Post Type Singular Name', 'kite'),
        'menu_name' => __('Team', 'kite'),
        'parent_item_colon' => __('Parent Team:', 'kite'),
        'all_items' => __('All Team', 'kite'),
        'view_item' => __('View Team', 'kite'),
        'add_new_item' => __('Add New Team', 'kite'),
        'add_new' => __('New Team', 'kite'),
        'edit_item' => __('Edit Team', 'kite'),
        'update_item' => __('Update Team', 'kite'),
        'search_items' => __('Search Team', 'kite'),
        'not_found' => __('No Team found', 'kite'),
        'not_found_in_trash' => __('No team found in Trash', 'kite'),
    );
    $args4 = array(
        'label' => __('Team', 'kite'),
        'description' => __('Team', 'kite'),
        'labels' => $labels4,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/img/icons/testimonial.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('team', $args4);

    $labels4 = array(
        'name' => _x('Price Table', 'Post Type General Name', 'kite'),
        'singular_name' => _x('Price Table', 'Post Type Singular Name', 'kite'),
        'menu_name' => __('Price Table', 'kite'),
        'parent_item_colon' => __('Parent Price Table:', 'kite'),
        'all_items' => __('All Price Table', 'kite'),
        'view_item' => __('View Price Table', 'kite'),
        'add_new_item' => __('Add New Price Table', 'kite'),
        'add_new' => __('New Price Table', 'kite'),
        'edit_item' => __('Edit Price Table', 'kite'),
        'update_item' => __('Update Price Table', 'kite'),
        'search_items' => __('Search Price Table', 'kite'),
        'not_found' => __('No Price Table found', 'kite'),
        'not_found_in_trash' => __('No Price Table found in Trash', 'kite'),
    );
    $args4 = array(
        'label' => __('Price Table', 'kite'),
        'description' => __('Price Table', 'kite'),
        'labels' => $labels4,
        'supports' => array('title'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/img/icons/testimonial.png',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('price', $args4);
}

add_action('init', 'kite_custom_posts', 0);
function get_custom_post($type,$limit){
    $args = array(
        'post_type' => $type,
        'posts_per_page' => $limit,
    );
    $loop = new WP_Query( $args );
    wp_reset_postdata();
    return $loop;
}

function create_portfolio_taxonomies() {
    $labels = array(
        'name'              => _x( 'Portfolio Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Portfolio Categories' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categories' ),
    );

    register_taxonomy( 'portfolio_categories', array( 'portfolio' ), $args );
}
add_action( 'init', 'create_portfolio_taxonomies', 0 );

add_filter( 'post_class', 'theme_t_wp_taxonomy_post_class', 10, 3 );
function theme_t_wp_taxonomy_post_class( $classes, $class, $ID ) {
    $taxonomy = 'portfolio_categories';
    $terms = get_the_terms( (int) $ID, $taxonomy );
    if( !empty( $terms ) ) {
        foreach( (array) $terms as $order => $term ) {
            if( !in_array( $term->slug, $classes ) ) {
                $classes[] = $term->slug;
            }
        }
    }
    return $classes;
}

/* Kite Commnet fomr with Bootstrap */

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    return $fields;
}
add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
function bootstrap3_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    return $args;
}
add_action('comment_form', 'bootstrap3_comment_button' );
function bootstrap3_comment_button() {
    echo '<button class="btn btn-default" type="submit">' . __( 'Post Comment' ) . '</button>';
}

function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
function my_twentyten_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'my_twentyten_excerpt_length' );

function get_blog_post($limit,$off){
    $args = array( 'posts_per_page' => $limit,'offset'=> $off ,'order' => 'DESC');
    $loop = get_posts($args);
    return $loop;
}