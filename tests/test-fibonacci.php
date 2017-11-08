<?php

use lloc\Fibonacci\Fibonacci;

class LLOC_Test_Fibonacci extends LLOC_Framework_TestCase {

	public function test_first_ten() {
		$itr = new Fibonacci();
		$arr = [];
		$i   = 0;
		foreach ( $itr as $fn ) {
			$arr[] = $fn;

			if ( $i ++ === 9 ) {
				break;
			}
		}

		$this->assertEquals( [ 1, 1, 2, 3, 5, 8, 13, 21, 34, 55 ], $arr );
	}

	public function test_set_constructor_vars() {
		$itr = new Fibonacci( 34, 55, 9 );


		$this->assertEquals( 55, $itr->current() );

		$itr->next();

		$this->assertEquals( 89, $itr->current() );
	}

	public function test_set_get() {
		$itr = new Fibonacci();

		$arr = [ 'previous' => 0, 'current' => 1, 'key' => 0 ];
		$this->assertEquals( $arr, $itr->get() );

		$itr = $itr->set( 1, 2, 1 );

		$this->assertInstanceOf( 'lloc\Fibonacci\Fibonacci', $itr );

		$arr = [ 'previous' => 1, 'current' => 2, 'key' => 1 ];
		$this->assertEquals( $arr, $itr->get() );
	}

}
