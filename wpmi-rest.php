<?php
/*
Plugin Name: WPMI Rest
Plugin URI: http://github.com/lloc/wpmi-rest/
Description: Let’s do the time warp Again
Author: Dennis Ploetner
Version: 0.1
Author URI: http://lloc.de/
*/

namespace realloc\WPMI_Rest;

use Composer\DependencyResolver\Transaction;

interface Factory {

	/**
	 * @return Factory
	 */
	public static function init(): self;

}

abstract class Crud {

	abstract public function create();

	abstract public function read();

	abstract public function update();

	abstract public function delete();

}

class AjaxArray extends Crud implements Factory {

	public static function init(): Factory {
		$obj = new self();

		add_action( 'wp_ajax_wpmi_create', [ $obj, 'create' ] );
		add_action( 'wp_ajax_nopriv_wpmi_create', [ $obj, 'create' ] );

		add_action( 'wp_ajax_wpmi_update', [ $obj, 'read' ] );
		add_action( 'wp_ajax_nopriv_update', [ $obj, 'read' ] );

		add_action( 'wp_ajax_wpmi_update', [ $obj, 'update' ] );
		add_action( 'wp_ajax_nopriv_update', [ $obj, 'update' ] );

		add_action( 'wp_ajax_wpmi_delete', [ $obj, 'delete' ] );
		add_action( 'wp_ajax_nopriv_delete', [ $obj, 'delete' ] );

		return $obj;
	}

	public function create() {
		$token  = wp_create_nonce( __CLASS__ );
		$option = $this->set_name( $token );

		add_option( $option, [] );
		wp_send_json_success( $token );
	}

	public function read() {
		$option = $this->get_name();
		$data   = get_option( $option, [] );

		wp_send_json_success( array_sum( $data ) );
	}

	public function update() {
		$option = $this->get_name();
		$data   = get_option( $option );
		$num    = $_POST['num'] ?? 0;
		$data[] = intval( $num );

		update_option( $option, $data );

		wp_send_json_success( $data );
	}

	public function delete() {
		$option = $this->get_name();

		delete_option( $option );

		wp_send_json_success( 'OK' );
	}

	/**
	 * @param string $name
	 *
	 * @return string
	 */
	protected function set_name( string $name ): string {
		return "AjaxArray_{$name}";
	}

	protected function get_name() {
		if ( check_ajax_referer( __CLASS__, 'token', false ) ) {
			return $this->set_name( $_REQUEST['token'] );
		}

		wp_send_json_error( 'KO' );
	}

}

add_action( 'init', function () {
	AjaxArray::init();
} );

add_action( 'wp_enqueue_scripts', function () {
	$handle = 'wpmi-rest';
	$src    = plugins_url( 'js/wpmi-rest.js', __FILE__ );

	wp_enqueue_script( $handle, $src, [ 'jquery' ] );
	wp_localize_script( $handle, 'WPMI', [
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	] );
} );
