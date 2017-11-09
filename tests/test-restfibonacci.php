<?php

use lloc\Fibonacci\RestFibonacci;

class LLOC_Test_AjaxFibonacci extends LLOC_Framework_TestCase {

	public function get_test() {
		\WP_Mock::passthruFunction( 'rest_ensure_response' );

		\WP_Mock::userFunction( 'get_option', [ 'return' => [ 'previous' => 1, 'current' => 2, 'key' => 2 ] ] );
		\WP_Mock::userFunction( 'update_option', [ 'return' => true ] );
		\WP_Mock::userFunction( 'delete_option', [ 'return' => true ] );

		return RestFibonacci::init();
	}

	public function test_create() {
		$this->assertEquals( 'Existing sequence loaded', $this->get_test()->create() );
	}

	public function test_read() {
		$this->assertEquals( '2', $this->get_test()->read() );
	}

	public function test_update() {
		$this->assertEquals( 'Sequence updated', $this->get_test()->update() );
	}

	public function test_delete() {
		$this->assertEquals( 'Sequence deleted', $this->get_test()->delete() );
	}

}
