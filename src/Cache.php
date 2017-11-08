<?php

namespace lloc\Fibonacci;

/**
 * Class Cache
 * @package lloc\Fibonacci
 */
abstract class Cache {

	/**
	 * @var mixed $thing
	 */
	protected $thing;

	/**
	 * @param mixed $thing
	 *
	 * @return mixed
	 */
	abstract public function set_cache( $thing ): self;

	/**
	 * @return mixed
	 */
	abstract public function get_cache();

	/**
	 * @return bool
	 */
	abstract public function save_cache(): bool;

	/**
	 * @return bool
	 */
	abstract public function delete_cache(): bool;

}