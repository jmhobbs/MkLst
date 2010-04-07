<?php
	require_once( dirname( __FILE__ ) . '/application.php' );

	class Page_Controller extends Application_Controller {

		function __call ( $name, $arguments ) {
			$view = new View( 'page/' . strtolower( $name ) );
			if( ! $view->exists() ) {
				$view = new View( 'error/404' );
			}
			$this->view->content = $view;
		}

	}
