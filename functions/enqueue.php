<?php
// ENQUEUE STYLES
function enqueue_styles(){

    if(is_rtl()){ // TODO: not sure if supposed to be here or not yet (Hila)
        wp_register_style('bootstrap-rtl', THEME . '/assets/bootstrap/bootstrap-rtl.min.css', array(), NULL, 'all'); wp_enqueue_style('bootstrap-rtl');
    }

    if(ENV == 'dev'){
        wp_register_style('assets', THEME . '/css/assets.min.css', array(), NULL, 'all'); wp_enqueue_style('assets');
        wp_register_style('style', THEME . '/css/style.css', array(), NULL, 'all'); wp_enqueue_style('style');
        wp_register_style('responsive', THEME . '/css/responsive.css', array(), NULL, 'all'); wp_enqueue_style('responsive');
        wp_register_style('rtl', THEME . '/css/rtl-style.css', array(), NULL, 'all'); wp_enqueue_style('rtl');
    }else{
        wp_register_style('production', THEME . '/css/production.min.css', array(), NULL, 'all'); wp_enqueue_style('production');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_styles'); // Add Theme Stylesheet

// ENQUEUE SCRIPTS
function enqueue_scripts() {

    wp_register_script( 'googleapi', 'https://maps.googleapis.com/maps/api/js?language=en&key='.GOOGLE_API_KEY, array( 'jquery' ), NULL, false ); wp_enqueue_script( 'googleapi' ); // load script in header

    if(ENV == 'dev'){
        wp_register_script( 'assets', THEME . '/js/assets.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'assets' );
        wp_register_script( 'scripts', THEME . '/js/scripts.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'scripts' );
    }
    else{
        wp_register_script( 'production', THEME . '/js/production.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'production' );
    }

    // wp_register_script( 'tether', THEME . '/assets/bootstrap/tether.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'tether' ); // must be before bootstrap
	// wp_register_script( 'bootstrap-js', THEME . '/assets/bootstrap/bootstrap.min.js', array( 'jquery' ), NULL, true ); wp_enqueue_script( 'bootstrap-js' );

}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
