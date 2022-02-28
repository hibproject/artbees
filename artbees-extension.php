<?php
/**
 * Plugin Name: Artbees Extensions
 * Description: Custom elementor widget that Based on the needs of the employer and it has 2 phases, for more information read <strong><a href="https://artbees.notion.site/Wordpress-Developer-2022-51e0aa40eb7447bfa937f16dd3e219a2">documentation</a></strong>.
 * Plugin URI:  https://bproject.space
 * Version:     1.0.0
 * Author:      Alireza B.
 * Author URI:  https://bproject.space
 * Text Domain: artbees-extensions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register List Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_list_widget( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/class-imagelist-extension.php' );
	$widgets_manager->register( new \Elementor_List_Widget() );
}
add_action( 'elementor/widgets/register', 'register_list_widget' );

/**
 * 
 * Proper way to enqueue scripts and styles
 * 
 */
function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'primary', plugin_dir_url( __FILE__ ) . 'assets/css/primary.css' );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );