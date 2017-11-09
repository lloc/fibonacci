<?php

use lloc\Fibonacci\RestFibonacci;

class LLOC_Test_AjaxFibonacci extends LLOC_Framework_TestCase {

	public function test_factory() {
		\WP_Mock::userFunction( 'wp_create_nonce', [ 'return' => '97a2dcb969' ] );

		$obj = RestFibonacci::init();
	}

}
