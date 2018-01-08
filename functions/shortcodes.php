<?php

add_shortcode('first_shortcode','first_shortcode_handler');
function first_shortcode_handler($atts){
    extract(shortcode_atts(array(
                            'title' => 'Default Title'
                            ), $atts)
    );

    ob_start();

    return ob_get_clean();
}
