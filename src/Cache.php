<?php

namespace lloc\Fibonacci;

abstract class Cache {

	protected $thing;

	abstract public function set_cache( $thing );

	abstract public function get_cache();

	abstract public function save_cache();

	abstract public function delete_cache();

}