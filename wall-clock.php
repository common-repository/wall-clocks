<?php
/*
Plugin Name: Wall Clock
Plugin URI: bubaidas.coolpage.biz
Description: Wall clock plugin is a plugin that shows variety clock with date, time, location and more
features.
Version: 2.0
Author: Bubai Das
Contributors: Owner
*/
?>
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
function as_slider_activation() {
}
register_activation_hook(__FILE__, 'as_slider_activation');

function as_slider_deactivation() {
}
register_deactivation_hook(__FILE__, 'as_slider_deactivation');

add_action('wp_enqueue_scripts', 'as_slider_scripts');


/* script */
function as_slider_scripts() {
	wp_enqueue_script('jquery');
	wp_register_script('clock_core', plugins_url('js/jClocksGMT.js', __FILE__));
	
	/* get option data */
	include('option-data.php');
	//send plugin url

	wp_localize_script('clock_core', 'wordpress_vars', 
                     array('plugin_path' => plugin_dir_url(__FILE__),'user_loc' => $user_loc, 'an_clock_type' => $an_clock_type, 'dg_clock_type' => $dg_clock_type, 
					 'dt_clock_type' => $dt_clock_type, 'time_format' => $time_format, 'custom_title' => $custom_title, 
					 'clock_meridiem' => $clock_meridiem, 'analog_model' => $analog_model, ' custom_title' =>  $custom_title ));
	wp_enqueue_script('clock_core');
	
	
	wp_register_script('clock_roated', plugins_url('js/jquery.rotate.js', __FILE__));
	wp_enqueue_script('clock_roated');
	

	
	wp_register_script('custom_roated', plugins_url('js/as-custom.js', __FILE__));
	//send option data
	wp_localize_script('custom_roated', 'plugin_data', 
                     array('user_loc' => $user_loc, 'an_clock_type' => $an_clock_type, 'dg_clock_type' => $dg_clock_type, 
					 'dt_clock_type' => $dt_clock_type, 'time_format' => $time_format, 'custom_title' => $custom_title, 
					 'clock_meridiem' => $clock_meridiem, 'analog_model' => $analog_model, ' custom_title' =>  $custom_title ));
	wp_enqueue_script('custom_roated');
	
	
	
}

add_action('wp_enqueue_scripts', 'as_slider_styles');
function as_slider_styles() {
	wp_register_style('clock_gmt', plugins_url('css/jClocksGMT.css', __FILE__));
	wp_enqueue_style('clock_gmt');	
	
}

function as_shortcode() {

	$output = '
	<div class="asCLock-container">
		<div id="title"></div>
		<div id="clock_hou"></div>
        <div id="clock_india"></div>
        <div id="clock_korea"></div>
        <div id="clock_uk"></div>
        <div id="clock_tokyo"></div>
	</div>';
	return $output;
}
add_shortcode( 'asclock', 'as_shortcode' );


	/* creating option*/
include('theme-option.php');

