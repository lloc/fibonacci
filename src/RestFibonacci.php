<?php

/**
 * RestFibonacci
 */

namespace lloc\Fibonacci;

/**
 * Class RestFibonacci
 * @package lloc\Fibonacci
 */
class RestFibonacci extends AutoCache implements Factory, Crud {

	const namespace = 'fibonacci/v1';

	/**
	 * @return Factory
	 */
	public static function init(): Factory {
		$obj = new self();

		add_action( 'rest_api_init', [ $obj, 'rest_api_init' ] );

		return $obj;
	}

	/**
	 * @codeCoveragIgnore
	 */
	public function rest_api_init() {
		register_rest_route( self::namespace,
			'/sequence', [
				[
					'methods'  => 'POST',
					'callback' => [ $this, 'create' ],
				],
				[
					'methods'  => 'GET',
					'callback' => [ $this, 'read' ],
				],
				[
					'methods'  => 'PUT',
					'callback' => [ $this, 'update' ],
				],
				[
					'methods'  => 'DELETE',
					'callback' => [ $this, 'delete' ],
				],
			]
		);
	}

	public function create() {
		$seq = $this->get_cache();

		if ( $seq ) {
			return new \WP_REST_Response( 'Existing sequence loaded' );
		}

		$seq = new Fibonacci();
		$this->set_cache( $seq->get() );

		return new \WP_REST_Response( 'Sequence created' );
	}

	public function read() {
		$arr = $this->get_cache();

		if ( $arr ) {
			$seq = new Fibonacci( $arr['previous'], $arr['current'], $arr['key'] );

			return new \WP_REST_Response( $seq->current() );
		}

		return new \WP_REST_Response( 'KO', 418 );
	}

	public function update() {
		$arr = $this->get_cache();

		if ( $arr ) {
			$seq = new Fibonacci( $arr['previous'], $arr['current'], $arr['key'] );
			$seq->next();
			$this->set_cache( $seq->get() );

			return new \WP_REST_Response( 'Sequence updated' );
		}

		return new \WP_REST_Response( 'KO', 418 );
	}

	public function delete() {
		$this->delete_cache();

		return new \WP_REST_Response( 'Sequence deleted' );
	}

}
