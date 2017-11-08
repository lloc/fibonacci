<?php

namespace lloc\Fibonacci;

/**
 * Interface Crud
 * @package lloc\Fibonacci
 */
interface Crud {

	public function create();

	public function read();

	public function update();

	public function delete();

}