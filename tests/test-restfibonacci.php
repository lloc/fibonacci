<?php

use lloc\Fibonacci\RestFibonacci;

class LLOC_Test_AjaxFibonacci extends LLOC_Framework_TestCase {

	public function test_factory() {
		$obj = RestFibonacci::init();
	}

}
