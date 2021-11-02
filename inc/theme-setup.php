<?php

require_once __DIR__ . '/manifest.php';
require_once __DIR__ . '/security.php';

// allow upload svg
function allow_svg_type($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_type');

function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus(
        array(
            'main' => "Main Navigation",
        )
    );
    
    if(function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            "page_title"  => "Test Theme Options",
            "menu_title"  => "Test Options",
            "menu_slug"   => "theme-general-settings",
            "redirect"    => false
        ));
    }
}
add_action('after_setup_theme', 'theme_setup');

function theme_enqueue_style() {
    $manifest = Manifest::getInstance();

    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/dist/' . $manifest->getAsset('main.css'), array(), NULL);
}
 
function theme_enqueue_script() {
    $manifest = Manifest::getInstance();

    wp_register_script('main-js', get_template_directory_uri() . '/dist/' . $manifest->getAsset('main.js'), array('jquery'), NULL, true);
    wp_localize_script('main-js', 'wp', array('service_time' => get_field('service_times', 'options')));
    wp_enqueue_script('main-js');
}
 
add_action( 'wp_enqueue_scripts', 'theme_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );

function head_code() {
    the_field('head_code', 'options');
}
add_action('wp_head', 'head_code', 2);

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    // add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
   
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
?>