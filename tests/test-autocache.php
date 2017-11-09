<?php

use lloc\Fibonacci\AutoCache;

class LLOC_Test_AutoCache extends LLOC_Framework_TestCase {

	public function test_quickndirty() {
		\WP_Mock::userFunction( 'wp_create_nonce', [ 'return' => '97a2dcb969' ] );
		\WP_Mock::userFunction( 'get_option', [ 'return' => 'pippo' ] );
		\WP_Mock::userFunction( 'update_option', [ 'return' => true ] );

		$obj = new AutoCache();

		$this->assertEquals( 'pippo', $obj->get_cache() );
		$this->assertEquals( $obj, $obj->set_cache( 'pluto' ) );
		$this->assertEquals( 'pluto', $obj->get_cache() );
	}

	public function test_save() {
		\WP_Mock::userFunction( 'update_option', [ 'return' => true ] );

		$obj = new AutoCache();

		$this->assertTrue( $obj->save_cache() );
	}

	public function test_delete() {
		\WP_Mock::userFunction( 'delete_option', [ 'return' => true ] );

		$obj = new AutoCache();

		$this->assertTrue( $obj->delete_cache() );
	}

}
