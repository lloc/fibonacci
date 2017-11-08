<?php

/**
 * AjaxFibonacci
 */

namespace lloc\Fibonacci;

/**
 * Class AjaxFibonacci
 * @package lloc\Fibonacci
 */
class AjaxFibonacci extends AutoCache implements Factory, Crud {

	/**
	 * @return Factory
	 */
	public static function init(): Factory {
		$obj = new self();

		add_action( 'wp_ajax_fibonacci_create', [ $obj, 'create' ] );
		add_action( 'wp_ajax_nopriv_fibonacci_create', [ $obj, 'create' ] );

		add_action( 'wp_ajax_fibonacci_read', [ $obj, 'read' ] );
		add_action( 'wp_ajax_nopriv_fibonacci_read', [ $obj, 'read' ] );

		add_action( 'wp_ajax_fibonacci_update', [ $obj, 'update' ] );
		add_action( 'wp_ajax_nopriv_fibonacci_update', [ $obj, 'update' ] );

		add_action( 'wp_ajax_fibonacci_delete', [ $obj, 'delete' ] );
		add_action( 'wp_ajax_nopriv_fibonacci_delete', [ $obj, 'delete' ] );

		return $obj;
	}

	public function create() {
		$seq = $this->get_cache();

		if ( $seq ) {
			wp_send_json_success( 'Existing sequence loaded' );
		}

		$seq = new Fibonacci();
		$this->set_cache( $seq->get() );

		wp_send_json_success( 'Sequence created' );
	}

	public function read() {
		$arr = $this->get_cache();

		if ( $arr ) {
			$seq = new Fibonacci( $arr['previous'], $arr['current'], $arr['key'] );

			wp_send_json_success( $seq->current() );
		}

		wp_send_json_error( 'KO' );
	}

	public function update() {
		$arr = $this->get_cache();

		if ( $arr ) {
			$seq = new Fibonacci( $arr['previous'], $arr['current'], $arr['key'] );
			$seq->next();
			$this->set_cache( $seq->get() );

			wp_send_json_success( 'Sequence updated' );
		}

		wp_send_json_error( 'KO' );
	}

	public function delete() {
		$this->delete_cache();

		wp_send_json_success( 'Sequence deleted' );
	}

}
