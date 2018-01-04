<?php
/*****************************************
**  Languages
*****************************************/
add_action('after_setup_theme', 'imaginet_theme_textdomain');
function imaginet_theme_textdomain(){
    load_theme_textdomain('imaginet', THEME . '/languages'); // Localisation Support
}
/*****************************************
**  Define
*****************************************/
if( !defined('THEME') ){
    define("THEME", get_template_directory_uri());
}
define('ENV', 'dev'); // only when developing, after that change it to ''
define( 'TEMPLATEPATH', get_template_directory() );
define( 'GOOGLE_API_KEY', 'AIzaSyBy6RN81sRyD-Slu8YAXlrV_Qa61Uf1UPI' );
/*****************************************
**  Includes
****************************************/
get_template_part("functions/enqueue");
get_template_part("functions/tgm");
get_template_part("functions/shortcodes");
get_template_part("functions/ajax");
get_template_part("admin/types-and-taxonomies");

/*****************************************
**  Theme Support
*****************************************/
if (function_exists('add_theme_support')){
    // Add Menu Support
    add_theme_support('menus');
	// Add custom logo
    add_theme_support( 'custom-logo' );

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
    // Enable support for wp galleries with figure tag
    add_theme_support( 'html5', array( 'gallery' ) );
}

// Register Blank Navigation
register_nav_menus(array( // Using array to specify more menus if needed
    'main-menu' => __('Main Menu', 'imaginet'), // Main Navigation
    'mobile-menu' => __('Mobile Menu', 'imaginet') // Mobile Navigation
));

// Register sidebars
if (function_exists('register_sidebar')) {
    $sidebar_array = array(
        array('name'=>'Main Sidebar','id'=>'main_sidebar'),
        array('name'=>'Blog','id'=>'blog_sidebar')
    );
    foreach($sidebar_array as $sidebar){
        register_sidebar(array(
            'name' => $sidebar['name'],
            'id' => $sidebar['id'],
            'description' => __('Drag here menu widgets to put in the sidebar', 'imaginet'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	    'after_widget'  => '</div>',
    		'before_title' => '<h2 class="widget_title">',
            'after_title' => '</h2>'
        ));
    }
}

// Add Theme Stylesheet To ADMIN
add_action('admin_enqueue_scripts', 'qs_admin_theme_styles');
function qs_admin_theme_styles(){
    wp_register_style('admin-style', THEME . '/admin/admin-style.css', array(), NULL, 'all'); wp_enqueue_style('admin-style');
}

// Add body classes
if ( ! function_exists( 'add_body_class' ) ){
    function add_body_class( $classes ) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if( $is_lynx ) $classes[] = 'lynx';
        elseif( $is_gecko ) $classes[] = 'gecko';
        elseif( $is_opera ) $classes[] = 'opera';
        elseif( $is_NS4 ) $classes[] = 'ns4';
        elseif( $is_safari ) $classes[] = 'safari';
        elseif( $is_chrome ) $classes[] = 'chrome';
        elseif( $is_IE ) {
            $classes[] = 'ie';
            if( preg_match( '/MSIE ( [0-11]+ )( [a-zA-Z0-9.]+ )/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) )
            $classes[] = 'ie' . $browser_version[1];
        } else $classes[] = 'unknown';
        if( $is_iphone ) $classes[] = 'iphone';

        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
        }

        return $classes;
    }
    add_filter( 'body_class','add_body_class' );
}

// initialize ACF Google Maps API
function my_acf_init() {
	acf_update_setting('google_api_key', GOOGLE_API_KEY);
}
add_action('acf/init', 'my_acf_init');

// Advanced Custom Fields Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'General Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function imaginet_pagination(){
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
// Add Custom Pagination
add_action('init', 'imaginet_pagination'); // Add our Pagination

// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)

// Remove the excerpt more 'read more btn'
function remove_excerpt_more($more) {
       global $post;
	return '';
}
add_filter('excerpt_more', 'remove_excerpt_more');

// Change the excerpt length
function new_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

// tinymce color pallete
function my_mce4_options( $init ) {
    $default_colours = '';
    $custom_colours = '
    	"16b1af", "Turquoise",
    	"df7d28", "Orange",
    	"a7cf3e", "Light Green",
        "2f9de0", "Blue Sky",
    	"fff", "White",
        "7d7d7d" , "Light Gray",
        "555555" , "Dark Gray"
    ';
    // build colour grid default+custom colors
    $init['textcolor_map'] = '['.$custom_colours.','.$default_colours.']';
    // enable 6th row for custom colours in grid
      $init['textcolor_rows'] = 6;
    return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

/***************************************** no hebrew files  ********/
add_filter('wp_handle_upload_prefilter', 'hebrew_files_prevent');
function hebrew_files_prevent($file) {
    $filename = $file['name'];
	if (preg_match('/[אבגדהוזחטיכלמנסעפצקרשתףץךםן]/', $filename, $matches)){
	  $file['error'] = 'נא לא להעלות קבצים עם שמות בעברית!';
	}
    return $file;
}
