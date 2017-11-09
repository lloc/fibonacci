<?php

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
	 * @codeCoverageIgnore
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

	/**
	 * @return \WP_REST_Response|\WP_Error|\WP_HTTP_Response
	 */
	public function create() {
		$seq = $this->get_cache();

		if ( $seq ) {
			return rest_ensure_response( 'Existing sequence loaded' );
		}

		$seq = new Fibonacci();
		$this->set_cache( $seq->get() );

		return rest_ensure_response( 'Sequence created' );
	}

	/**
	 * @return \WP_REST_Response|\WP_Error|\WP_HTTP_Response
	 */
	public function read() {
		$arr = $this->get_cache();

		if ( ! $arr ) {
			return new \WP_REST_Response( 'KO', 418 );
		}

		$seq = new Fibonacci( $arr['previous'], $arr['current'], $arr['key'] );

		return rest_ensure_response( $seq->current() );
	}

	/**
	 * @return \WP_REST_Response|\WP_Error|\WP_HTTP_Response
	 */
	public function update() {
		$arr = $this->get_cache();

		if ( ! $arr ) {
			return new \WP_REST_Response( 'KO', 418 );
		}

		$seq = new Fibonacci( $arr['previous'], $arr['current'], $arr['key'] );
		$seq->next();
		$this->set_cache( $seq->get() );

		return rest_ensure_response( 'Sequence updated' );
	}

	/**
	 * @return \WP_REST_Response|\WP_Error|\WP_HTTP_Response
	 */
	public function delete() {
		$this->delete_cache();

		return rest_ensure_response( 'Sequence deleted' );
	}

}
