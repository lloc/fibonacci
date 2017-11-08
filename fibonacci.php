<?php
/*
Plugin Name: Fibonacci
Plugin URI: http://github.com/lloc/fibonacci/
Description: Demonstrates the technical aspects of my speech about the transition from Wordpress AJAX endpoints to Rest API
Author: Dennis Ploetner
Version: 0.0.1
Author URI: http://lloc.de/
*/

require_once __DIR__ . '/vendor/autoload.php';

add_action( 'init', function () {
	lloc\Fibonacci\AjaxFibonacci::init();
} );

add_action( 'wp_enqueue_scripts', function () {
	$handle = 'fibonacci';
	$src    = plugins_url( 'js/fibonacci.js', __FILE__ );

	wp_enqueue_script( $handle, $src, [ 'jquery' ] );
	wp_localize_script( $handle, 'LLOC', [
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );
} );
