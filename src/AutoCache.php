<?php

namespace lloc\Fibonacci;

/**
 * Class AutoCache
 * @package lloc\Fibonacci
 */
class AutoCache extends Cache {

	/**
	 * @var string $name
	 */
	protected $name;

	/**
	 * AutoCache constructor.
	 */
	public function __construct() {
		$token      = wp_create_nonce( __CLASS__ );
		$this->name = sprintf( 'AutoCache_%s', $token );
	}

	public function __destruct() {
		if ( $this->thing ) {
			$this->save_cache();
		}
	}

	/**
	 * @param mixed $thing
	 *
	 * @return AutoCache
	 */
	public function set_cache( $thing ): self {
		$this->thing = $thing;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function get_cache() {
		return get_option( $this->name );
	}

	/**
	 * @return bool
	 */
	public function save_cache() {
		return update_option( $this->name, $this->thing, false );
	}

	/**
	 * @return bool
	 */
	public function delete_cache() {
		$this->thing = null;

		return delete_option( $this->name );
	}

}
