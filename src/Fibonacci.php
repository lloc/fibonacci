<?php

namespace lloc\Fibonacci;

/**
 * Class Fibonacci
 * @package lloc\Fibonacci
 */
class Fibonacci implements \Iterator {

	/**
	 * @var int $previous
	 * @var int $current
	 * @var int $key
	 */
	protected
		$previous,
		$current,
		$key;

	/**
	 * Fibonacci constructor.
	 *
	 * @param int $previous
	 * @param int $current
	 * @param int $key
	 */
	public function __construct( int $previous = 0, int $current = 1, int $key = 0 ) {
		$this->set( $previous, $current, $key );
	}

	/**
	 * @param int $previous
	 * @param int $current
	 * @param int $key
	 *
	 * @return Fibonacci
	 */
	public function set( int $previous, int $current, int $key ): Fibonacci {
		$this->previous = $previous;
		$this->current  = $current;
		$this->key      = $key;

		return $this;
	}

	/**
	 * @return array
	 */
	public function get(): array {
		return [
			'previous' => $this->previous,
			'current'  => $this->current,
			'key'      => $this->key
		];
	}

	public function current() {
		return $this->current;
	}

	public function next() {
		$temp           = $this->current;
		$this->current  += $this->previous;
		$this->previous = $temp;

		$this->key++;
	}

	/**
	 * @return mixed
	 */
	public function key() {
		return $this->key;
	}

	/**
	 * @return bool
	 */
	public function valid() {
		return true;
	}

	public function rewind() {
		$this->set( 0, 1, 0 );
	}

}