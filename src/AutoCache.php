<?php

namespace lloc\Fibonacci;

/**
 * Class AutoCache
 * @package lloc\Fibonacci
 */
class AutoCache extends Cache {

	protected $name;

	public function __construct() {
		$token      = wp_create_nonce( __CLASS__ );
		$this->name = sprintf( 'AutoCache_%s', $token );
	}

	public function __destruct() {
		if ( $this->thing ) {
			$this->save_cache();
		}
	}

	public function set_cache( $thing ) {
		$this->thing = $thing;
	}

	public function get_cache() {
		return get_option( $this->name );
	}

	public function save_cache() {
		update_option( $this->name, $this->thing, false );
	}

	public function delete_cache() {
		$this->thing = null;

		delete_option( $this->name );
	}

}
